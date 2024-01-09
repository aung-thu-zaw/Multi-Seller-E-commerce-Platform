<?php

namespace Database\Seeders;

use App\Models\UserProductView;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProductViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserProductView::factory(500)->create();
    }
}
