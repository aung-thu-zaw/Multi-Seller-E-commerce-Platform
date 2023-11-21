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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("brand_id")->nullable()->constrained()->nullOnDelete();
            $table->foreignId("category_id")->nullable()->constrained()->nullOnDelete();
            $table->foreignId("seller_id")->references("id")->on("users")->cascadeOnDelete();
            $table->string("thumb_image");
            $table->string("name");
            $table->string("slug");
            $table->text("description");
            $table->string("sku")->nullable();
            $table->integer("qty");
            $table->decimal('price', 8, 2);
            $table->decimal('offer_price', 8, 2)->nullable();
            $table->date('offer_start_date')->nullable();
            $table->date('offer_end_date')->nullable();
            $table->boolean('is_top')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft','pending', 'approved', 'disapproved'])->default('draft');
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
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