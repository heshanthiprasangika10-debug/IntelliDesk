<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_form_is_available(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('Sign In')
            ->assertSee('action="'.route('login.store').'"', false);
    }

    public function test_user_can_log_in_and_log_out(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
        $this->get('/dashboard')->assertOk()->assertSee($user->name);

        $this->post('/logout')->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_invalid_login_returns_an_error(): void
    {
        $this->from('/login')
            ->post('/login', [
                'email' => 'person@example.com',
                'password' => 'incorrect',
            ])
            ->assertRedirect('/login')
            ->assertSessionHasErrors('email');
    }

    public function test_user_can_register(): void
    {
        $this->get('/register')->assertOk()->assertSee('Create your account');

        $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect(route('login'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    public function test_dashboard_requires_authentication(): void
    {
        $this->get('/dashboard')->assertRedirect(route('login'));
    }

    public function test_authenticated_user_is_redirected_to_dashboard_from_login(): void
    {
        $this->actingAs(User::factory()->create())
            ->get('/login')
            ->assertRedirect('/dashboard');
    }
}
