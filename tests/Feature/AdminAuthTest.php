<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin dashboard redirects to login if user is unauthenticated.
     */
    public function test_admin_dashboard_redirects_unauthenticated_user_to_login(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/admin/login');
    }

    /**
     * Test admin login page can be rendered.
     */
    public function test_admin_login_page_can_be_rendered(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('Email');
    }

    /**
     * Test admin can login with valid credentials.
     */
    public function test_admin_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@cetaktalilanyard.com',
            'password' => bcrypt('admin123'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@cetaktalilanyard.com',
            'password' => 'admin123',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test login fails with invalid credentials.
     */
    public function test_admin_cannot_login_with_invalid_credentials(): void
    {
        User::factory()->create([
            'email' => 'admin@cetaktalilanyard.com',
            'password' => bcrypt('admin123'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@cetaktalilanyard.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
