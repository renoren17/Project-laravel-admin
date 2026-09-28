<?php

namespace Tests\Feature;

use App\Models\AdminCode;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_owner_can_create_admin_codes(): void
    {
        $this->post('/register', [
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => 'Passw0rd123!',
            'password_confirmation' => 'Passw0rd123!',
            'terms' => 'on',
        ]);

        $this->get(route('owner.admin-codes'))->assertForbidden();

        $owner = User::where('email', 'user@example.com')->firstOrFail();
        $owner->forceFill([
            'role_id' => Role::firstOrCreate(['nama' => 'Owner'])->id,
        ])->save();
        $owner->refresh();

        $this->actingAs($owner)
            ->post(route('owner.admin-codes.store'), ['nama' => 'Admin Satu', 'no_id' => 'ID-001'])
            ->assertRedirect(route('owner.admin-codes'));

        $this->assertDatabaseHas('admin_codes', [
            'nama' => 'Admin Satu',
            'no_id' => 'ID-001',
            'user_id' => null,
        ]);
    }

    public function test_admin_code_can_be_used_only_once(): void
    {
        $ownerRole = Role::firstOrCreate(['nama' => 'Owner']);
        $profileId = DB::table('profiles')->insertGetId([
            'umur' => 0,
            'bio' => '',
            'alamat' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $owner = User::unguarded(function () use ($ownerRole, $profileId) {
            return User::create([
                'name' => 'Owner User',
                'email' => 'owner@example.com',
                'password' => 'Passw0rd123!',
                'role_id' => $ownerRole->id,
                'profile_id' => $profileId,
            ]);
        });

        $this->actingAs($owner)
            ->post(route('owner.admin-codes.store'), ['nama' => 'Admin Satu', 'no_id' => 'ID-001']);

        $code = AdminCode::firstOrFail();
        $registration = [
            'name' => 'Admin Satu',
            'email' => 'admin@example.com',
            'password' => 'Passw0rd123!',
            'password_confirmation' => 'Passw0rd123!',
            'terms' => 'on',
            'kode' => $code->kode,
        ];

        $this->post(route('register.admin.store'), $registration)
            ->assertRedirect(route('dashboard'));

        $this->assertNotNull($code->refresh()->user_id);

        $registration['email'] = 'second-admin@example.com';

        $this->post(route('register.admin.store'), $registration)
            ->assertSessionHasErrors('kode');

        $this->assertDatabaseCount('users', 2);
    }
}
