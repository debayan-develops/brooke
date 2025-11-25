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

       Schema::create('category_type_map', function (Blueprint $table) {
            $table->uuid('category_type_id');
            $table->uuid('content_category_id');
            $table->timestamps();

            //$table->primary(['category_type_id', 'content_category_id']);

            //$table->foreign('category_type_id')->references('id')->on('category_types')->onDelete('cascade');
            //$table->foreign('content_category_id')->references('id')->on('content_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_type_map');
    }
};
