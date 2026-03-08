<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NovelChapterModel;
use Carbon\Carbon;

class NovelChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chapters = [];
        $now = Carbon::now();

        // Generate 300 sequential chapters
        for ($i = 1; $i <= 300; $i++) {
            $chapters[] = [
                'novel_id'       => 1, // Attaching all 300 to Novel ID 1
                'chapter_number' => $i,
                'title'          => 'The Journey Continues - Part ' . $i,
                'description'    => '<p>This is the official test content for <strong>Chapter ' . $i . '</strong>. Our protagonist continues exploring the mystical realm, facing new challenges and uncovering hidden secrets.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>',
                'is_active'      => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ];

            // Insert in chunks of 100 to keep memory usage low and safe
            if ($i % 100 === 0) {
                NovelChapterModel::insert($chapters);
                $chapters = []; // Reset array after inserting
            }
        }

        // Insert any remaining chapters (just as a safety catch)
        if (!empty($chapters)) {
            NovelChapterModel::insert($chapters);
        }

        $this->command->info('Successfully added 300 chapters to Novel ID 1!');
    }
}