<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'Super Admin']);

        $superAdmin->syncPermissions(Permission::all());

        Role::create(['name' => 'CEO']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Moderator']);
        Role::create(['name' => 'Accountant']);
        Role::create(['name' => 'Marketing']);
    }
}
