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
            $table->string('uuid');
            $table->string('tracking_no');
            $table->integer('product_qty');
            $table->enum('payment_method', ['card','paypal','cash on delivery']);
            $table->enum('payment_status', ['pending', 'completed'])->default('pending');
            $table->timestamp('purchased_at')->nullable();
            $table->decimal('total_amount', 8, 2);
            $table->string('shipping_method');
            $table->double('shipping_fee', 8, 2);
            $table->enum('coupon_type', ['fixed','percentage'])->nullable();
            $table->string('coupon_amount')->nullable();
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
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
