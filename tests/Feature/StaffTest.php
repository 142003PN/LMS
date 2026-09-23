<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StaffTest extends TestCase
{
    use RefreshDatabase;

    public function test_head_teacher_or_deputy_head_teacher_can_manage_staff(): void
    {
        $headTeacher = User::factory()->create(['role' => User::HEAD_TEACHER]);
        $deputyHeadTeacher = User::factory()->create(['role' => User::DEPUTY_HEAD_TEACHER]);
        $department = Department::create(['name' => 'Science']);

        $this->actingAs($headTeacher)
            ->post('/staff', [
                'first_name' => 'Alice',
                'last_name' => 'Mwanza',
                'email' => 'alice@example.com',
                'phone_number' => '0950000001',
                'role' => User::TEACHER,
                'password' => 'password123',
                'dept_id' => $department->id,
                'nrc' => '12345/67/8',
            ])
            ->assertRedirect(route('staff.index'));

        $this->assertDatabaseHas('users', ['email' => 'alice@example.com', 'role' => User::TEACHER]);
        $createdUser = User::where('email', 'alice@example.com')->firstOrFail();
        $this->assertDatabaseHas('staff', ['user_id' => $createdUser->id, 'dept_id' => $department->id, 'nrc' => '12345/67/8']);

        $this->actingAs($deputyHeadTeacher)
            ->post('/staff', [
                'first_name' => 'Brian',
                'last_name' => 'Simukoko',
                'email' => 'brian@example.com',
                'phone_number' => '0950000002',
                'role' => User::HOD,
                'password' => 'password123',
                'dept_id' => $department->id,
                'nrc' => '54321/87/9',
            ])
            ->assertRedirect(route('staff.index'));
    }

    public function test_staff_editor_can_update_user_details_on_edit(): void
    {
        $headTeacher = User::factory()->create(['role' => User::HEAD_TEACHER]);
        $department = Department::create(['name' => 'Science']);
        $user = User::factory()->create([
            'first_name' => 'Old',
            'last_name' => 'Name',
            'email' => 'old@example.com',
            'phone_number' => '0950000011',
            'role' => User::TEACHER,
        ]);
        $staff = Staff::create(['user_id' => $user->id, 'dept_id' => $department->id, 'nrc' => '11111/22/3']);

        $this->actingAs($headTeacher)
            ->put(route('staff.update', $staff), [
                'first_name' => 'New',
                'last_name' => 'Staff',
                'email' => 'new@example.com',
                'phone_number' => '0950000099',
                'role' => User::HOD,
                'nrc' => '22222/33/4',
                'dept_id' => $department->id,
            ])
            ->assertRedirect(route('staff.show', $staff));

        $this->assertDatabaseHas('users', ['id' => $user->id, 'first_name' => 'New', 'last_name' => 'Staff', 'email' => 'new@example.com', 'phone_number' => '0950000099', 'role' => User::HOD]);
        $this->assertDatabaseHas('staff', ['id' => $staff->id, 'nrc' => '22222/33/4', 'dept_id' => $department->id]);
    }

    public function test_non_managers_cannot_create_or_update_staff_records(): void
    {
        $department = Department::create(['name' => 'Science']);
        $staffUser = User::factory()->create(['role' => User::TEACHER]);
        $staff = Staff::create(['user_id' => $staffUser->id, 'dept_id' => $department->id, 'nrc' => '12345/67/8']);

        $this->actingAs(User::factory()->create(['role' => User::HOD]))
            ->post('/staff', [
                'first_name' => 'Charlie',
                'last_name' => 'Nchito',
                'email' => 'charlie@example.com',
                'phone_number' => '0950000003',
                'role' => User::TEACHER,
                'password' => 'password123',
                'dept_id' => $department->id,
                'nrc' => '77777/11/1',
            ])
            ->assertForbidden();

        $this->actingAs($staffUser)
            ->put(route('staff.update', $staff), ['nrc' => '99999/99/9', 'dept_id' => $department->id])
            ->assertRedirect(route('staff.show', $staff));

        $this->assertDatabaseHas('staff', ['id' => $staff->id, 'nrc' => '99999/99/9']);
        $this->assertSame($department->id, $staff->fresh()->dept_id);
    }
}
