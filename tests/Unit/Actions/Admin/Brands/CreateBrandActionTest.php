<?php

namespace Tests\Unit\Actions\Admin\Brands;

use App\Actions\Admin\Brands\CreateBrandAction;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateBrandActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_the_create_brand_action_class_successfully_creates_a_new_brand(): void
    {
        // Arrange
        Storage::fake('public');
        $data = [
            'name' => 'Test Brand',
            'status' => 'active',
            'logo' => UploadedFile::fake()->image('fake-brand-logo.jpg'),
        ];

        $action = new CreateBrandAction();

        // Act
        $action->handle($data);

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
