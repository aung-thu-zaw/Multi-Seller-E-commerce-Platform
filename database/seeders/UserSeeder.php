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

        // Admin
        $admin = User::factory()->create([
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'Password!',
        ]);

        // Seller
        User::factory()->create([
            'name' => 'Seller',
            'role' => 'seller',
            'email' => 'seller@gmail.com',
            'password' => 'Password!',
        ]);

        // Buyer
        User::factory()->create([
            'name' => 'Customer',
            'role' => 'user',
            'email' => 'customer@gmail.com',
            'password' => 'Password!',
        ]);

        // 5 To 55
        User::factory(50)->create(['role' => 'seller', 'status' => 'active']);

        User::factory(10)->create(['role' => 'admin']);

        User::factory(100)->create(["role" => "user"]);
    }
}
