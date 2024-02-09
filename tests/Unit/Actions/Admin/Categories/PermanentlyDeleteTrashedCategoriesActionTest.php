<?php

namespace Tests\Unit\Actions\Admin\Categories;

use App\Actions\Admin\Categories\PermanentlyDeleteTrashedCategoriesAction;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermanentlyDeleteTrashedCategoriesActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_the_permanently_delete_trashed_categories_action_class_successfully_delete_trashed_categories(): void
    {
        // Arrange
        $categories = Category::factory(10)->create();

        $categories->each(function ($category) {
            $category->delete();
        });

        $action = new PermanentlyDeleteTrashedCategoriesAction();

        // Act
        $action->handle($categories);

        // Assert
        foreach ($categories as $category) {
            $this->assertDatabaseMissing('categories', ['id' => $category->id]);
            $this->assertDatabaseCount('categories', 0);
        }
    }
}
