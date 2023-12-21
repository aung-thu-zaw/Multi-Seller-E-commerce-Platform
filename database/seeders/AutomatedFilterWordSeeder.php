<?php

namespace Database\Seeders;

use App\Models\AutomatedFilterWord;
use Illuminate\Database\Seeder;

class AutomatedFilterWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AutomatedFilterWord::factory(100)->create();
    }
}
