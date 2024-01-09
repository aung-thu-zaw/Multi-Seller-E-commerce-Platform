<?php

namespace Database\Seeders;

use App\Models\ProductQuestionAnswer;
use Illuminate\Database\Seeder;

class ProductQuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductQuestionAnswer::factory(50)->create();
    }
}
