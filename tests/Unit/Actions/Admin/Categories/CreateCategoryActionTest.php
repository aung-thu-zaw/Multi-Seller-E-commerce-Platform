<?php

namespace Tests\Unit\Actions\Admin\Categories;

use App\Actions\Admin\Categories\CreateCategoryAction;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateCategoryActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_the_create_category_action_class_successfully_creates_a_new_category(): void
    {
        // Arrange
        Storage::fake('public');
        $data = [
            'parent_id' => null,
            'name' => 'Test Category',
            'status' => 'show',
            'image' => UploadedFile::fake()->image('fake-category-image.jpg'),
        ];

        $action = new CreateCategoryAction();

        // Act
        $action->handle($data);

        // Assert
        $this->assertDatabaseHas('categories', [
            'parent_id' => $data['parent_id'],
            'name' => $data['name'],
        ]);

        $category = Category::where('name', $data['name'])->first();
        $this->assertNotNull($category);
        $this->assertEquals($data['parent_id'], $category->parent_id);
        $this->assertEquals($data['name'], $category->name);
        $this->assertEquals($data['status'], $category->status);
    }
}
