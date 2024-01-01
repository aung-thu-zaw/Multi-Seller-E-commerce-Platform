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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('invoice_no');
            $table->integer('product_qty');
            $table->string('payment_method');
            $table->enum('payment_status', ['pending','paid']);
            $table->decimal('total_amount', 8, 2);
            $table->string('address');
            $table->string('shipping_method');
            $table->string('coupon')->nullable();
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->boolean('is_returned')->default(false);
            $table->boolean('is_refunded')->default(false);
            $table->boolean('is_canceled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
