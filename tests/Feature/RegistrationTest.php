<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_saves_user_and_authenticates_them(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Passw0rd123!',
            'password_confirmation' => 'Passw0rd123!',
            'terms' => 'on',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
        $user = User::where('email', 'test@example.com')->firstOrFail();
        $this->assertDatabaseHas('roles', ['id' => $user->role_id, 'nama' => 'User']);
        $this->assertDatabaseHas('profiles', ['id' => $user->profile_id]);
        $this->assertTrue(Hash::check('Passw0rd123!', $user->password));
    }

    public function test_registered_user_can_log_in(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Passw0rd123!',
            'password_confirmation' => 'Passw0rd123!',
            'terms' => 'on',
        ]);
        $response->assertRedirect(route('dashboard'));
        $this->post('/logout');

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'Passw0rd123!',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
    }

    public function test_profile_list_displays_name_email_bio_and_role(): void
    {
        Role::create(['nama' => 'admin']);

        $this->post('/register', [
            'name' => 'cinta',
            'email' => 'cinta0107@gmail.com',
            'password' => 'Passw0rd123!',
            'password_confirmation' => 'Passw0rd123!',
            'terms' => 'on',
        ])->assertRedirect(route('dashboard'));

        $user = User::where('email', 'cinta0107@gmail.com')->firstOrFail();
        $user->profile->update(['bio' => 'hello world']);

        $this->get(route('profiles.index'))
            ->assertOk()
            ->assertSee('cinta')
            ->assertSee('cinta0107@gmail.com')
            ->assertSee('hello world')
            ->assertSee('admin');
    }
}