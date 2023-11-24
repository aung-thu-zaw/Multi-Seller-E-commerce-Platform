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
        // Super Admin
        $superAdmin = User::factory()->create([
            'avatar' => 'admin-1.jpg',
            'name' => 'Super Admin',
            'role' => 'admin',
            'email' => 'superadmin@gmail.com',
            'password' => 'Password!',
        ]);

        $superAdmin->assignRole(1);

        $role = Role::with('permissions')
            ->where('id', 1)
            ->first();

        $superAdmin->syncPermissions($role->permissions);

        // Official Seller
        User::factory()->create([
            'name' => 'Seller',
            'role' => 'seller',
            'email' => 'seller@gmail.com',
            'password' => 'Password!',
        ]);

        // Individual Seller
        User::factory()->create([
            'name' => 'Myo Myo',
            'role' => 'seller',
            'email' => 'myomyo@gmail.com',
            'password' => 'Password!',
        ]);

        // Buyer
        User::factory()->create([
            'avatar' => 'user-4.jpg',
            'name' => 'Customer',
            'role' => 'user',
            'email' => 'customer@gmail.com',
            'password' => 'Password!',
        ]);

        User::factory(30)->create(['role' => 'user']);
    }
}
