<?php

namespace Database\Seeders;

use App\Models\FaqContent;
use Illuminate\Database\Seeder;

class FaqContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FaqContent::factory(200)->create();
    }
}
