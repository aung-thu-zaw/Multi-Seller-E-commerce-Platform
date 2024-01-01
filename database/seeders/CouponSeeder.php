<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::factory()->create(['code' => 'NEW CLIENT']);
        Coupon::factory()->create(['code' => 'HAPPY SHOPPING']);
        Coupon::factory()->create(['code' => 'CHRISTMAS SHOPPING']);
        Coupon::factory()->create(['code' => 'NEW YEAR SHOPPING']);
        Coupon::factory()->create(['code' => 'WEEKEND SHOPPING']);

        Coupon::factory(50)->create();
    }
}
