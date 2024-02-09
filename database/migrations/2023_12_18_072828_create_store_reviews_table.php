<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('store_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->text('comment');
            $table->integer('rating');
            $table->boolean('is_flagged')->default(false);
            $table->boolean('is_moderated')->default(false);
            $table->enum('status', ['approved', 'rejected'])->default('approved');
            $table->enum('response_status', ['awaiting', 'responded'])->default('awaiting');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_reviews');
    }
};
