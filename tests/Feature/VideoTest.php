<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_can_create_video(): void
    {
        $response = $this->postJson('/api/videos', [
            'title' => 'Sample Video',
            'url' => 'https://youtube.com/sample'
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('videos', ['title' => 'Sample Video']);
    }
}
