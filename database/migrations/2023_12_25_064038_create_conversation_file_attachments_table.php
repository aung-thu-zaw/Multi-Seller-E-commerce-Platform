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
        Schema::create('message_file_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("conversation_message_id")->nullable()->constrained()->cascadeOnDelete();
            $table->enum('type', ['image', 'video']);
            $table->string("attachment_path");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_file_attachments');
    }
};
