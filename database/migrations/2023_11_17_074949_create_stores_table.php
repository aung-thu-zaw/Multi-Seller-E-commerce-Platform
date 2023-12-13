<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('store_name')->unique();
            $table->string('cover')->nullable();
            $table->string('avatar');
            $table->string('slug')->unique();
            $table->boolean('is_verified')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->text('description')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('business_hours')->nullable();
            $table->string('location')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linked_in')->nullable();
            $table->text('additional_information')->nullable();
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
