<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = Collection::factory(50)->create();

        $collections->each(function ($collection) {
            $numberOfProducts = rand(5, 80);
            $products = Product::where("status", "published")->inRandomOrder()->take($numberOfProducts)->get();
            $collection->products()->attach($products->pluck('id'));
        });
    }
}
