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
        // 1. Create Blog Categories Table (Fixed "Table not found" error)
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // 2. Create Blogs Table (Updated columns to match Controller/Seeder)
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->longText('description')->nullable(); // Matches your Seeder
            $table->string('thumbnail_image')->nullable(); // Matches your Seeder
            $table->date('publish_date')->nullable();
            $table->string('author')->nullable();
            $table->integer('view_count')->default(0);
            $table->boolean('status')->default(1)->comment('0 = Draft, 1 = Published');
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->timestamps();
        });

        // 3. Create Pivot Table (Links Blogs to Categories)
        Schema::create('blog_category_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade');
            $table->foreignId('blog_category_id')->constrained('blog_categories')->onDelete('cascade');
        });

        // 4. Create Blog Images Table (For Slider Images)
        Schema::create('blog_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_images');
        Schema::dropIfExists('blog_category_relations');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_categories');
    }
};