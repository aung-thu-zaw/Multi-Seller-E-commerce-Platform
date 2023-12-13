<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seller_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->references('id')->on('users')->cascadeOnDelete();
            $table->enum('store_type', ['personal', 'business']);
            $table->string('store_name')->unique();
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('business_name')->nullable();
            $table->string('business_registration_number')->nullable();
            $table->string('tax_number')->unique()->nullable();
            $table->string('industry')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->text('business_description')->nullable();
            $table->text('products_or_services')->nullable();
            $table->text('additional_information')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_requests');
    }
};
