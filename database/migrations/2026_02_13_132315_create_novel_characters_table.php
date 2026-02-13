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
        Schema::create('novel_characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('novel_id')->constrained('novels')->onDelete('cascade');
            $table->foreignId('character_id')->constrained('characters')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novel_characters');
    }
};
