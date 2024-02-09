<?php

namespace Database\Seeders;

use App\Models\SellerRequest;
use Illuminate\Database\Seeder;

class SellerRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SellerRequest::factory(50)->create();
    }
}
