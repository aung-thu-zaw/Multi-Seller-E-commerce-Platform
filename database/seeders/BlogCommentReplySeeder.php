<?php

namespace Database\Seeders;

use App\Models\BlogCommentReply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogCommentReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogCommentReply::factory(20)->create();
    }
}
