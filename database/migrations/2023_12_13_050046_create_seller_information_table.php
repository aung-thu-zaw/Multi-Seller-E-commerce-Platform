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
        Schema::create('seller_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('store_id')->constrained();
            $table->string('store_contact_email')->nullable();
            $table->string('store_contact_phone')->nullable();
            $table->string('business_contact_email')->nullable();
            $table->string('business_contact_phone')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_registration_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('industry')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->text('business_description')->nullable();
            $table->text('products_or_services')->nullable();
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
        Schema::dropIfExists('seller_information');
    }
};
