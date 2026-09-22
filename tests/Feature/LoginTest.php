<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_users_can_login_and_reach_their_dashboard(): void
    {
        foreach (['head_teacher', 'hod', 'teacher', 'learner', 'deputy_head_teacher', 'accountant', 'stores_officer'] as $role) {
            Cache::flush();
            $user = User::factory()->create(['role' => $role]);
            $this->post('/login', ['id' => $user->id, 'password' => 'password'])
                ->assertRedirect(route($user->dashboard_route_name()));
            $this->assertAuthenticatedAs($user);
            $this->get(route($user->dashboard_route_name()))->assertOk();
            $this->post('/logout')->assertRedirect(route('login'));
            $this->assertGuest();
        }
    }

    public function test_invalid_credentials_preserve_only_the_id(): void
    {
        $user = User::factory()->create();
        $this->from('/')->post('/login', ['id' => $user->id, 'password' => 'wrong'])
            ->assertRedirect('/')
            ->assertSessionHasErrors('id')
            ->assertSessionHas('_old_input.id', $user->id)
            ->assertSessionMissing('_old_input.password');
        $this->assertGuest();
    }

    public function test_login_validates_required_fields_and_numeric_id(): void
    {
        $this->post('/login', [])->assertSessionHasErrors(['id', 'password']);
        $this->post('/login', ['id' => 'invalid', 'password' => 'password'])->assertSessionHasErrors('id');
        $this->assertGuest();
    }

    public function test_guests_cannot_access_dashboards(): void
    {
        foreach (['/dashboard', '/head', '/head/dashboard', '/hod/dashboard', '/teacher/dashboard', '/learner/dashboard'] as $path) {
            $this->get($path)->assertRedirect(route('login'));
        }
    }

    public function test_users_cannot_access_another_roles_dashboard(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'learner']));
        foreach (['/head', '/head/dashboard', '/hod/dashboard', '/teacher/dashboard'] as $path) {
            $this->get($path)->assertForbidden();
        }
    }

    public function test_authenticated_users_are_redirected_from_login(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'teacher']))
            ->get('/')->assertRedirect('/dashboard');
        $this->get('/dashboard')->assertRedirect(route('teacher.dashboard'));
    }

    public function test_login_respects_an_intended_protected_page(): void
    {
        $user = User::factory()->create(['role' => 'head_teacher']);
        $this->get('/head')->assertRedirect(route('login'));
        $this->post('/login', ['id' => $user->id, 'password' => 'password'])->assertRedirect('/head');
    }

    public function test_logout_invalidates_session_data(): void
    {
        $this->actingAs(User::factory()->create())->withSession(['private_data' => 'value'])
            ->post('/logout')->assertRedirect(route('login'))->assertSessionMissing('private_data');
        $this->assertGuest();
        $this->get('/dashboard')->assertRedirect(route('login'));
    }

    public function test_login_attempts_are_throttled(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post('/login', ['id' => 999, 'password' => 'wrong'])->assertSessionHasErrors('id');
        }
        $this->post('/login', ['id' => 999, 'password' => 'wrong'])->assertStatus(429);
    }

    public function test_role_helpers_compare_the_users_role(): void
    {
        $head = new User(['role' => 'head_teacher']);
        $hod = new User(['role' => 'hod']);
        $this->assertTrue($head->isHeadTeacher());
        $this->assertFalse($head->isHod());
        $this->assertTrue($hod->isHod());
        $this->assertFalse($hod->isHeadTeacher());
    }
}
