<?php

namespace Tests\Unit\Actions\Admin\Brands;

use App\Actions\Admin\Brands\UpdateBrandAction;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateBrandActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_the_update_brand_action_class_successfully_update_existing_old_brand(): void
    {
        // Arrange
        Storage::fake('public');
        $existingBrand = Brand::factory()->create();
        $data = [
            'name' => 'Test Brand',
            'status' => 'inactive',
            'image' => UploadedFile::fake()->image('fake-brand-image.jpg'),
        ];

        $action = new UpdateBrandAction();

        // Act
        $action->handle($data, $existingBrand);

        // Assert
        $this->assertDatabaseHas('brands', [
            'name' => $data['name'],
            'status' => $data['status'],
        ]);

        $brand = Brand::where('name', $data['name'])->first();
        $this->assertNotNull($brand);
        $this->assertEquals($data['name'], $brand->name);
        $this->assertEquals($data['status'], $brand->status);
    }
}
