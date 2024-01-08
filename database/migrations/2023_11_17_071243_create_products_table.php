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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->string('code')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('offer_price', 8, 2)->nullable();
            $table->date('offer_price_start_date')->nullable();
            $table->date('offer_price_end_date')->nullable();
            $table->integer('qty')->nullable();
            $table->string('image');
            $table->string('warranty_type')->nullable();
            $table->string('warranty_period')->nullable();
            $table->text('warranty_policy')->nullable();
            $table->string('return_day')->nullable();
            $table->text('return_policy')->nullable();
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('draft');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
