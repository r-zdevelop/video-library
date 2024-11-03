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
                'title' => 'How to get 1-2 ETHs Per Day Passive',
                'description' => 'Description for video 1.',
                'url' => 'https://www.youtube.com/embed/W-nyNQ6b4wo', // Embed link
            ],
            [
                'title' => 'The Complete TALL Stack Tutorial',
                'description' => 'Description for video 2.',
                'url' => 'https://www.youtube.com/embed/Ul3sfSDEt9U',
            ],
            [
                'title' => 'Ibiza Summer Mix 2024',
                'description' => 'Description for video 3.',
                'url' => 'https://www.youtube.com/embed/L-EF29ACmOs',
            ],
            [
                'title' => 'Así es vivir en las diminutas',
                'description' => 'Description for video 4.',
                'url' => 'https://www.youtube.com/embed/TibhkHG335w',
            ],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}
