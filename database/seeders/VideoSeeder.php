<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    public function run()
    {
        $videos = [
            [
                'title' => 'Video 1',
                'description' => 'Description for video 1.',
                'url' => 'https://www.youtube.com/embed/W-nyNQ6b4wo', // Embed link
            ],
            [
                'title' => 'Video 2',
                'description' => 'Description for video 2.',
                'url' => 'https://www.youtube.com/embed/Ul3sfSDEt9U',
            ],
            [
                'title' => 'Video 3',
                'description' => 'Description for video 3.',
                'url' => 'https://www.youtube.com/embed/L-EF29ACmOs',
            ],
            [
                'title' => 'Video 4',
                'description' => 'Description for video 4.',
                'url' => 'https://www.youtube.com/embed/TibhkHG335w',
            ],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}
