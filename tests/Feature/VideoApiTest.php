<?php

namespace Tests\Feature;

use App\Constants\Attributes;
use App\Constants\Roles;
use Tests\TestCase;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class VideoApiTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create an admin and a regular user
        $this->admin = User::factory()->create([Attributes::ROLE => Roles::ADMIN]);
        $this->user = User::factory()->create([Attributes::ROLE => Roles::USER]);
    }

    #[Test]
    public function admin_can_create_video()
    {
        Sanctum::actingAs($this->admin);

        $response = $this->postJson('/api/videos', [
            'title' => 'Sample Video',
            'description' => 'Sample Description',
            'url' => 'https://www.youtube.com/watch?v=sample'
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('title', 'Sample Video');
    }

    #[Test]
    public function admin_can_update_video()
    {
        Sanctum::actingAs($this->admin);
        $video = Video::factory()->create();

        $response = $this->putJson("/api/videos/{$video->id}", [
            'title' => 'Updated Title'
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('title', 'Updated Title');
    }

    #[Test]
    public function admin_can_delete_video()
    {
        Sanctum::actingAs($this->admin);
        $video = Video::factory()->create();

        $response = $this->deleteJson("/api/videos/{$video->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('videos', ['id' => $video->id]);
    }

    #[Test]
    public function user_can_view_video_list()
    {
        Video::factory()->count(5)->create();
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/videos');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    #[Test]
    public function user_can_view_video_details()
    {
        $video = Video::factory()->create();
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/videos/{$video->id}");

        $response->assertStatus(200)
            ->assertJsonPath('id', $video->id);
    }

    #[Test]
    public function view_count_increments_on_video_view()
    {
        $video = Video::factory()->create(['views' => 0]);
        Sanctum::actingAs($this->user);

        $response = $this->postJson("/api/videos/{$video->id}/view");

        $response->assertStatus(200);
        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
            'views' => 1
        ]);
    }

    #[Test]
    public function search_count_increments_on_video_search()
    {
        $video1 = Video::factory()->create(['title' => 'Test Video One', 'search_count' => 0]);
        $video2 = Video::factory()->create(['title' => 'Test Video Two', 'search_count' => 0]);
        Sanctum::actingAs($this->user);

        $response = $this->postJson('/api/videos/search', ['query' => 'Test']);

        $response->assertStatus(200);
        $this->assertDatabaseHas('videos', [
            'id' => $video1->id,
            'search_count' => 1
        ]);
        $this->assertDatabaseHas('videos', [
            'id' => $video2->id,
            'search_count' => 1
        ]);
    }
}
