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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->integer('qty');
            $table->json('attributes')->nullable();
            $table->decimal('unit_price', 8, 2);
            $table->decimal('total_price', 8, 2);
            $table->enum('status', ['pending', 'processing', 'ready to ship' ,'shipped', 'delivered'])->default('pending');
            $table->timestamp("processing_date")->nullable();
            $table->timestamp("ready_to_ship_date")->nullable();
            $table->timestamp("shipped_date")->nullable();
            $table->timestamp("delivered_date")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
