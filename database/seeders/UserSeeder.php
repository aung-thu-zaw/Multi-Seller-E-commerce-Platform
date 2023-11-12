<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'role' => 'admin',
            'email' => 'superadmin@gmail.com',
            'password' => 'Password!',
        ]);

        $superAdmin->assignRole(1);

        $role = Role::with('permissions')->where('id', 1)->first();

        $superAdmin->syncPermissions($role->permissions);

        User::factory()->create([
            'name' => 'Seller',
            'role' => 'seller',
            'email' => 'seller@gmail.com',
            'password' => 'Password!',
        ]);

        User::factory()->create([
            'name' => 'Customer',
            'role' => 'user',
            'email' => 'customer@gmail.com',
            'password' => 'Password!',
        ]);
    }
}
