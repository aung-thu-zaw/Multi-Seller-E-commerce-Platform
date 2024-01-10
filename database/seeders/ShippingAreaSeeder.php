<?php

namespace Database\Seeders;

use App\Models\ShippingArea;
use Illuminate\Database\Seeder;

class ShippingAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingArea::factory(300)->create();
    }
}
