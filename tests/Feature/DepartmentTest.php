<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        $this->actingAs(User::factory()->create(['role' => 'head_teacher']));
    }

    public function test_head_teacher_can_complete_the_web_crud_flow(): void
    {
        $head = User::factory()->create(['role' => 'hod']);
        $this->get('/department')->assertOk()->assertSee('No departments yet.');
        $this->get('/department/create')->assertOk()->assertSee($head->first_name);
        $this->post('/department', ['name' => 'Science', 'hod_id' => $head->id])->assertSessionHasNoErrors();
        $department = Department::sole();
        $this->assertEquals($head->id, $department->hod_id);
        $this->get('/department')->assertOk()->assertSee('Science');
        $this->get(route('department.show', $department))->assertOk()->assertSee($head->email);
        $this->get(route('department.edit', $department))->assertOk()->assertSee('Science');
        $this->put(route('department.update', $department), ['name' => 'Science', 'hod_id' => ''])
            ->assertRedirect(route('department.show', $department));
        $this->assertNull($department->fresh()->hod_id);
        $this->put(route('department.update', $department), ['name' => 'Mathematics'])
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('departments', ['id' => $department->id, 'name' => 'Mathematics']);
        $this->delete(route('department.destroy', $department))->assertRedirect(route('department.index'));
        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }

    public function test_validation_rejects_bad_names_and_ineligible_heads(): void
    {
        $department = Department::create(['name' => 'Science']);
        $other = Department::create(['name' => 'Arts']);
        $teacher = User::factory()->create(['role' => 'teacher']);
        foreach ([[], ['name' => str_repeat('a', 21)], ['name' => 'Science']] as $input) {
            $this->postJson('/department', $input)->assertUnprocessable()->assertJsonValidationErrors('name');
        }
        foreach ([$teacher->id, 999999, 'invalid'] as $head) {
            $this->postJson('/department', ['name' => 'New', 'hod_id' => $head])
                ->assertUnprocessable()->assertJsonValidationErrors('hod_id');
        }
        $this->putJson(route('department.update', $other), ['name' => $department->name])
            ->assertUnprocessable()->assertJsonValidationErrors('name');
        $this->assertDatabaseCount('departments', 2);
    }

    public function test_invalid_form_input_returns_errors_without_changing_the_department(): void
    {
        $department = Department::create(['name' => 'Science']);
        $this->from(route('department.edit', $department))
            ->put(route('department.update', $department), ['name' => '', 'hod_id' => 999999])
            ->assertRedirect(route('department.edit', $department))
            ->assertSessionHasErrors(['name', 'hod_id']);
        $this->assertDatabaseHas('departments', ['id' => $department->id, 'name' => 'Science']);
        $this->delete(route('department.destroy', $department))->assertRedirect(route('department.index'));
        $this->get(route('department.show', $department))->assertNotFound();
    }

    public function test_every_department_action_rejects_other_roles(): void
    {
        $department = Department::create(['name' => 'Science']);
        foreach (['learner', 'teacher', 'hod', 'deputy_head_teacher', 'accountant', 'stores_officer'] as $role) {
            $this->actingAs(User::factory()->create(['role' => $role]));
            foreach (['/department', '/department/create', '/department/'.$department->id, '/department/'.$department->id.'/edit'] as $url) {
                $this->get($url)->assertForbidden();
            }
            $this->postJson('/department', ['name' => 'Arts'])->assertForbidden();
            $this->putJson('/department/'.$department->id, ['name' => 'Arts'])->assertForbidden();
            $this->deleteJson('/department/'.$department->id)->assertForbidden();
        }
        $this->assertDatabaseHas('departments', ['id' => $department->id, 'name' => 'Science']);
        $this->assertDatabaseCount('departments', 1);
    }

    public function test_guests_must_login(): void
    {
        auth()->logout();
        $this->get('/department')->assertRedirect(route('login'));
        $this->postJson('/department', ['name' => 'Science'])->assertUnauthorized();
    }

    public function test_deleting_a_head_preserves_the_department(): void
    {
        $head = User::factory()->create(['role' => 'hod']);
        $department = Department::create(['name' => 'Science', 'hod_id' => $head->id]);
        $head->delete();
        $this->assertNull($department->fresh()->hod_id);
    }
}
