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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('region_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('township_id')->constrained();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('postal_code')->nullable();
            $table->string('address');
            $table->string('landmark')->nullable();
            $table->boolean('is_default_billing')->default(false);
            $table->boolean('is_default_delivery')->default(false);
            $table->enum('address_type', ['home', 'office'])->default('home');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
