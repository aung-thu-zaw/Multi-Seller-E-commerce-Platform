<?php

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

use function Pest\Laravel\actingAs;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(TestCase::class, RefreshDatabase::class)->beforeEach(fn () => $this->seed([PermissionSeeder::class, RoleSeeder::class]))->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function actingAsAuthenticatedUser(string $role = 'user'): User
{
    $user = User::factory()->create(['role' => $role]);

    actingAs($user);

    return $user;
}

function actingAsSuperAdmin(): User
{
    $superAdmin = User::factory()->create(['role' => 'admin']);

    $superAdmin->assignRole('Super Admin');

    $role = Role::with('permissions')->where('name', 'Super Admin')->first();

    $superAdmin->syncPermissions($role->permissions);

    actingAs($superAdmin);

    return $superAdmin;
}

function queryStringParams(): array
{
    return [
        'page' => '1',
        'per_page' => '5',
        'sort' => 'id',
        'direction' => 'desc',
    ];
}
