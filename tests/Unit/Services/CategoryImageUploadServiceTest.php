<?php

namespace Tests\Unit\Services;

use App\Services\UploadFiles\CategoryImageUploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CategoryImageUploadServiceTest extends TestCase
{
    public function test_that_the_create_image_method_successfully_creates_a_new_category_image(): void
    {
        // Arrange
        Storage::fake("public");
        $image = UploadedFile::fake()->image('fake-category-image.jpg');
        $service = new CategoryImageUploadService();

        // Act
        $fileName = $service->createImage($image);

        // Assert
        Storage::assertExists("categories/$fileName");
    }

    public function test_that_the_update_image_method_successfully_updates_a_new_category_image_and_delete_existing_old_category_image(): void
    {
        // Arrange
        Storage::fake("public");
        $image = UploadedFile::fake()->image('new-fake-category-image.jpg');
        $existingImage = 'existing-fake-category-image.jpg';
        $service = new CategoryImageUploadService();

        // Act
        $fileName = $service->updateImage($image, $existingImage);

        // Assert
        Storage::assertExists("categories/$fileName");
        Storage::assertMissing("categories/$existingImage");
    }
}
