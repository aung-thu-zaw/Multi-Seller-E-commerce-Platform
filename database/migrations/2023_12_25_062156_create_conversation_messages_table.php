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
        Schema::create('conversation_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('conversations')->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('users');
            $table->foreignId('store_id')->nullable()->constrained('stores');
            $table->enum('type', ['text', 'image', 'video'])->default("text");
            $table->text('message')->nullable();
            $table->boolean("is_deleted_by_user")->default(false);
            $table->boolean("is_deleted_by_agent")->default(false);
            $table->foreignId("reply_to_message_id")->nullable()->references("id")->on("conversation_messages")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_messages');
    }
};
