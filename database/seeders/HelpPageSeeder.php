<?php

namespace Database\Seeders;

use App\Models\HelpPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HelpPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HelpPage::factory()->create(['title' => 'Terms And Conditions']);

        HelpPage::factory()->create(['title' => 'Privacy And Policy']);

        HelpPage::factory()->create(['title' => 'Returns And Refunds']);
    }
}
