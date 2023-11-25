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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('avatar')->nullable();
            $table->enum('store_type', ['official', 'non_official'])->default('non_official');
            $table->string('namecl')->unique();
            $table->string('slug')->unique();
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('tax_number')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
