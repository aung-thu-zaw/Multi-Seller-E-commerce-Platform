<?php

namespace Tests\Unit\Actions\Admin\Brands;

use App\Actions\Admin\Brands\PermanentlyDeleteTrashedBrandsAction;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermanentlyDeleteTrashedBrandsActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_the_permanently_delete_trashed_brands_action_class_successfully_delete_trashed_brands(): void
    {
        // Arrange
        $brands = Brand::factory(10)->create();

        $brands->each(function ($brand) {
            $brand->delete();
        });

        $action = new PermanentlyDeleteTrashedBrandsAction();

        // Act
        $action->handle($brands);

        // Assert
        foreach ($brands as $brand) {
            $this->assertDatabaseMissing('brands', ['id' => $brand->id]);
            $this->assertDatabaseCount('brands', 0);
        }
    }
}
