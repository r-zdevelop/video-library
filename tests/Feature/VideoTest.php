<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    public function test_video_views_increment_on_show()
    {
        // Create a user and a video for testing
        $user = User::factory()->create();
        $video = Video::factory()->create(['views' => 0]);

        // Act as the user to visit the video show route
        $this->actingAs($user)
            ->get(route('videos.show', $video->id));

        // Reload the video from the database to check the updated views count
        $video->refresh();

        // Assert that the views count has been incremented by 1
        $this->assertEquals(1, $video->views);
    }

    public function test_video_search_count_increments_on_search()
    {
        // Create a user and two videos that match the search criteria
        $user = User::factory()->create();
        $video1 = Video::factory()->create(['title' => 'Test Video One', 'search_count' => 0]);
        $video2 = Video::factory()->create(['title' => 'Test Video Two', 'search_count' => 0]);

        // Act as the user and perform a search
        $this->actingAs($user)
            ->get(route('videos.index', ['search' => 'Test']));

        // Reload the videos from the database
        $video1->refresh();
        $video2->refresh();

        // Assert that the search_count has been incremented for both videos
        $this->assertEquals(1, $video1->search_count);
        $this->assertEquals(1, $video2->search_count);
    }
}
