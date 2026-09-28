<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['User', 'Admin', 'Owner'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'nama' => $roleName,
            ]);
        }
    }
}
