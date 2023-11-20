<?php

namespace Tests\Unit\Actions\Admin\Categories;

use App\Actions\Admin\Categories\UpdateCategoryAction;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateCategoryActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_the_update_category_action_class_successfully_update_existing_old_category(): void
    {
        // Arrange
        Storage::fake('public');
        $existingCategory = Category::factory()->create();
        $data = [
            'parent_id' => null,
            'name' => 'Test Category',
            'status' => 'hide',
            'image' => UploadedFile::fake()->image('fake-category-image.jpg'),
        ];

        $action = new UpdateCategoryAction();

        // Act
        $action->handle($data, $existingCategory);

        // Assert
        $this->assertDatabaseHas('categories', [
            'parent_id' => $data['parent_id'],
            'name' => $data['name'],
            'status' => $data['status'],
        ]);

        $category = Category::where('name', $data['name'])->first();
        $this->assertNotNull($category);
        $this->assertEquals($data['parent_id'], $category->parent_id);
        $this->assertEquals($data['name'], $category->name);
        $this->assertEquals($data['status'], $category->status);
    }
}
