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
            $table->string('cover')->nullable();
            $table->string('avatar');
            $table->enum('store_type', ['personal', 'business']);
            $table->string('store_name')->unique();
            $table->string('slug')->unique();
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('nrc')->unique()->nullable();
            $table->string('tax_number')->unique()->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->enum('status', ['active', 'suspended'])->default('suspended');
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
