<?php

namespace Database\Seeders;

use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Database\Seeder;

class FlashSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flashSale = FlashSale::factory()->create();

        $numberOfProducts = rand(30, 100);
        $products = Product::where('status', 'approved')->inRandomOrder()->take($numberOfProducts)->get();
        $flashSale->products()->attach($products->pluck('id'));
    }
}
