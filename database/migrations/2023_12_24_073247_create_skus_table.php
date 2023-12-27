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
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->constrained();
            $table->string("code");
            $table->decimal('price', 8, 2);
            $table->integer('qty')->default(0);
            $table->timestamps();


            // $table->decimal('price', 8, 2);
            // $table->decimal('offer_price', 8, 2)->nullable();
            // $table->date('offer_price_start_date')->nullable();
            // $table->date('offer_price_end_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skus');
    }
};
