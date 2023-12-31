<?php

use App\Models\Category;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;
use function PHPUnit\Framework\assertEquals;

it('prevents non-admin from accessing the category list page', function () {
    // Act & Assert
    actingAsAuthenticatedUser(role: 'user');

    get(route('admin.categories.index'))->assertForbidden();
});

it('allows admin to access the category list page and verifies correct props', function () {
    // Arrange
    Category::factory(10)->create();

    // Act & Assert
    actingAsSuperAdmin();

    get(route('admin.categories.index'))
        ->assertOk()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('Admin/Categories/Index')
                ->has('categories')
                ->has('categories.data', 5)
                ->has(
                    'categories.data.0',
                    fn (Assert $page) => $page
                        ->where('id', 10)
                        ->etc(),
                ),
        );
});

it('prevents non-admin from accessing the category create page', function () {
    // Act & Assert
    actingAsAuthenticatedUser(role: 'user');

    get(route('admin.categories.create'))->assertForbidden();
});

it('allows admin to access the category create page and verifies correct props', function () {
    // Arrange
    Category::factory(10)->create();

    // Act & Assert
    actingAsSuperAdmin();

    get(route('admin.categories.create'))
        ->assertOk()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('Admin/Categories/Create')
                ->has('categories', 10)
                ->has(
                    'categories.0',
                    fn (Assert $page) => $page
                        ->has('id')
                        ->has('parent_id')
                        ->has('name'),
                ),
        );
});

it('redirects back to the form with validation errors on category creation failure', function () {
    // Act & Assert
    actingAsSuperAdmin();

    post(route('admin.categories.store'), [
        'name' => 'Test Category',
        'status' => '',
        'image' => '',
    ])
        ->assertStatus(302)
        ->assertSessionHasErrors(['status']);
});

it('successfully creates a category as an admin', function () {
    // Arrange
    $category = [
        'parent_id' => null,
        'name' => 'Test Category',
        'status' => 'show',
    ];

    // Act & Assert
    actingAsSuperAdmin();

    post(route('admin.categories.store'), $category)
        ->assertStatus(302)
        ->assertRedirect(route('admin.categories.index', queryStringParams()))
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success');

    assertDatabaseHas('categories', $category);

    $latestCategory = Category::latest()->first();
    assertEquals($category['name'], $latestCategory->name);
    assertEquals($category['status'], $latestCategory->status);
});

it('prevents non-admin from accessing the category edit page', function () {
    // Arrange
    $category = Category::factory()->create();

    // Act & Assert
    actingAsAuthenticatedUser(role: 'user');

    get(route('admin.categories.edit', $category))->assertForbidden();
});

it('allows admin to access the category edit page and verifies correct props', function () {
    // Arrange
    $categories = Category::factory(10)->create();
    $category = Category::factory()->create();

    // Act & Assert
    actingAsSuperAdmin();

    get(route('admin.categories.edit', $category))
        ->assertOk()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('Admin/Categories/Edit')
                ->has(
                    'category',
                    fn (Assert $page) => $page
                        ->where('id', $category->id)
                        ->where('name', $category->name)
                        ->etc(),
                )
                ->has('categories', 11)
                ->has(
                    'categories.0',
                    fn (Assert $page) => $page
                        ->has('id')
                        ->has('parent_id')
                        ->has('name'),
                ),
        );
});

it('redirects back to the form with validation errors on category update failure', function () {
    // Arrange
    $category = Category::factory()->create();

    // Act & Assert
    actingAsSuperAdmin();

    patch(route('admin.categories.update', $category), [
        'name' => 'Edit Category',
        'status' => 'false',
    ])
        ->assertStatus(302)
        ->assertSessionHasErrors(['status']);
});

it('successfully updates a category as an admin', function () {
    // Arrange
    $category = Category::factory()->create();

    $updateData = [
        'parent_id' => null,
        'name' => 'Update Category',
        'status' => 'hide',
    ];

    // Act & Assert
    actingAsSuperAdmin();

    patch(route('admin.categories.update', $category), $updateData)
        ->assertStatus(302)
        ->assertRedirect(route('admin.categories.index', queryStringParams()))
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success');

    assertDatabaseHas('categories', $updateData);

    $latestCategory = Category::latest()->first();
    assertEquals($updateData['parent_id'], $latestCategory->parent_id);
    assertEquals($updateData['name'], $latestCategory->name);
    assertEquals($updateData['status'], $latestCategory->status);
});

it('successfully soft deletes a category as an admin', function () {
    // Arrange
    $category = Category::factory()->create();
    $array = $category->toArray();

    // Act & Assert
    actingAsSuperAdmin();

    delete(route('admin.categories.destroy', $category))
        ->assertStatus(302)
        ->assertRedirect(route('admin.categories.index', queryStringParams()));

    assertSoftDeleted('categories', ['id' => $category->id]);
});

it('successfully soft delete selected category as an admin', function () {
    // Arrange
    $categories = Category::factory(3)->create();
    $selectedItems = $categories->pluck('id')->implode(',');

    // Act & Assert
    actingAsSuperAdmin();

    delete(route('admin.categories.destroy.selected', $selectedItems))
        ->assertStatus(302)
        ->assertRedirect(route('admin.categories.index', queryStringParams()));

    foreach ($categories as $category) {
        assertSoftDeleted('categories', ['id' => $category->id]);
    }
});

it('prevents non-admin from accessing the category trashed list page', function () {
    // Act & Assert
    actingAsAuthenticatedUser(role: 'user');

    get(route('admin.categories.trashed'))->assertForbidden();
});

it('allows admin to access the category trashed list page and verifies correct props', function () {
    // Arrange
    $categories = Category::factory(8)->create();

    $categories->each(function ($category) {
        $category->delete();
    });

    // Act & Assert
    actingAsSuperAdmin();

    get(route('admin.categories.trashed'))
        ->assertOk()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('Admin/Categories/Trash')
                ->has('trashedCategories')
                ->has('trashedCategories.data', 5)
                ->has('trashedCategories.data.0', fn (Assert $page) => $page->where('id', 8)->etc()),
        );
});

it('successfully restores a category as an admin', function () {
    // Arrange
    $category = Category::factory()->create();
    $category->delete();

    // Act & Assert
    actingAsSuperAdmin();

    post(route('admin.categories.restore', $category->id))
        ->assertStatus(302)
        ->assertRedirect(route('admin.categories.trashed', queryStringParams()));

    assertDatabaseHas('categories', ['id' => $category->id, 'deleted_at' => null]);
});

it('successfully restore selected trashed category as an admin', function () {
    // Arrange
    $categories = Category::factory(3)->create();

    $categories->each(function ($category) {
        $category->delete();
    });

    $selectedItems = $categories->pluck('id')->implode(',');

    // Act & Assert
    actingAsSuperAdmin();

    post(route('admin.categories.restore.selected', $selectedItems))
        ->assertStatus(302)
        ->assertRedirect(route('admin.categories.trashed', queryStringParams()));

    foreach ($categories as $category) {
        assertDatabaseHas('categories', ['id' => $category->id, 'deleted_at' => null]);
    }
});

it('successfully force deletes a trashed category as an admin', function () {
    // Arrange
    $category = Category::factory()->create();
    $category->delete();

    // Act & Assert
    actingAsSuperAdmin();

    delete(route('admin.categories.force-delete', $category->id))
        ->assertStatus(302)
        ->assertRedirect(route('admin.categories.trashed', queryStringParams()));

    assertDatabaseMissing('categories', ['id' => $category->id]);
    assertDatabaseCount('categories', 0);
});

it('successfully force delete selected trashed category as an admin', function () {
    // Arrange
    $categories = Category::factory(3)->create();

    $categories->each(function ($category) {
        $category->delete();
    });

    $selectedItems = $categories->pluck('id')->implode(',');

    // Act & Assert
    actingAsSuperAdmin();

    delete(route('admin.categories.force-delete.selected', $selectedItems))
        ->assertStatus(302)
        ->assertRedirect(route('admin.categories.trashed', queryStringParams()));

    foreach ($categories as $category) {
        assertDatabaseMissing('categories', ['id' => $category->id]);
        assertDatabaseCount('categories', 0);
    }
});

it('successfully force delete all trashed category as an admin', function () {
    // Arrange
    $categories = Category::factory(5)->create();

    $categories->each(function ($category) {
        $category->delete();
    });

    // Act & Assert
    actingAsSuperAdmin();

    delete(route('admin.categories.force-delete.all'))
        ->assertStatus(302)
        ->assertRedirect(route('admin.categories.trashed', queryStringParams()));

    foreach ($categories as $category) {
        assertDatabaseMissing('categories', ['id' => $category->id]);
        assertDatabaseCount('categories', 0);
    }
});
