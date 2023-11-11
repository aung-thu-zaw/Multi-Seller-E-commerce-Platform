<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'role' => 'admin',
            'email' => 'superadmin@gmail.com',
            'password' => 'Password!',
        ]);

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
