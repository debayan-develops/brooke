<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShortStories;
use App\Admin\Content\Domain\Models\ContentCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ShortStorySeeder extends Seeder
{
    public function run()
    {
        // 1. Setup the "Real" Storage Path
        // This matches the folder structure your Admin Panel uses
        $storagePath = 'short_stories/thumbnails'; 
        $fileName = 'dummy.jpeg';
        $dbPath = $storagePath . '/' . $fileName; // Value to save in DB

        // 2. Ensure the directory exists in the Storage disk
        Storage::disk('public')->makeDirectory($storagePath);

        // 3. Copy the "Master" image from public/images to the storage folder
        // This ensures the file physically exists where Laravel looks for it
        $sourcePath = public_path('images/' . $fileName);
        $destinationPath = storage_path('app/public/' . $dbPath);

        if (File::exists($sourcePath)) {
            File::copy($sourcePath, $destinationPath);
        } else {
            $this->command->error("Source image not found at $sourcePath. Please place dummy.jpg in public/images/");
            return;
        }

        // 4. Get valid Categories (Exclude junk)
        $categories = ContentCategory::whereNotIn('name', ['GGG', 'gfni', 'nbvnvn', 'vsdvds'])->get();

        if ($categories->isEmpty()) {
            $this->command->info('No valid categories found! Please seed categories first.');
            return;
        }

        // 5. Generate Data
        for ($i = 0; $i < 20; $i++) {
            $story = ShortStories::create([
                'title' => fake()->sentence(4),
                'short_description' => fake()->paragraph(3),
                'short_story_details' => fake()->paragraphs(5, true),
                'thumbnail_photo' => $dbPath, // <--- SAVES: short_stories/thumbnails/dummy.jpg
                'status' => 1,
                'created_by' => 1,
                'created_at' => now(),
            ]);

            $story->shortStoryCategories()->attach($categories->random()->id);
        }
    }
}