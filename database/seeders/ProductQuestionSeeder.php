<?php

namespace Database\Seeders;

use App\Models\ProductQuestion;
use Illuminate\Database\Seeder;

class ProductQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductQuestion::factory(30)->create();
    }
}
