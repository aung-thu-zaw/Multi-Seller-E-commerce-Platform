<?php

namespace Tests\Unit\Services;

use App\Http\Traits\ImageUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUploadTraitTest extends TestCase
{
    use ImageUpload;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    public function test_create_image(): void
    {
        // Arrange
        $image = UploadedFile::fake()->image('fake-image.jpg');
        $folderName = 'categories';

        // Act
        $fileName = $this->createImage($image, $folderName);

        // Assert
        Storage::assertExists("$folderName/$fileName");
    }

    public function test_update_image_with_old_image(): void
    {
        // Arrange
        $image = UploadedFile::fake()->image('new-fake-image.jpg');
        $oldImage = 'existing-fake-image.jpg';
        $folderName = 'categories';

        // Act
        $fileName = $this->updateImage($image, $oldImage, $folderName);

        // Assert
        Storage::assertExists("$folderName/$fileName");
        Storage::assertMissing("$folderName/$oldImage");
    }

    public function test_update_image_without_old_image(): void
    {
        // Arrange
        $image = UploadedFile::fake()->image('new-fake-image.jpg');
        $folderName = 'categories';

        // Act
        $fileName = $this->updateImage($image, null, $folderName);

        // Assert
        Storage::assertExists("$folderName/$fileName");
    }
}
