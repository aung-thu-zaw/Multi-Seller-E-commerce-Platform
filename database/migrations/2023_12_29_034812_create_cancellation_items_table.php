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
        Schema::create('cancellation_items', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->foreignId('order_item_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->text('reason');
            $table->integer('qty');
            $table->decimal('unit_price', 8, 2);
            $table->decimal('total_price', 8, 2);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default("pending");
            $table->timestamp('cancelled_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->text('comments')->nullable();
            $table->decimal('refund_amount', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cancellation_items');
    }
};
