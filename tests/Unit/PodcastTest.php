<?php

namespace Tests\Unit;

use App\Podcast;
use Tests\TestCase;

class PodcastTest extends TestCase
{

    public function test_can_list_podcasts()
    {
        factory(Podcast::class, 2)->create()->map(function ($podcast) {
            return $podcast->only(['id', 'name', 'description']);
        });
        $this->get(route('podcasts'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'description'],
                ]
            ]);
    }

    public function test_can_create_podcast()
    {
        $data = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'marketing_url' => $this->faker->url,
            'feed_url' => $this->faker->url,
        ];
        $this->post(route('podcasts.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }

    public function test_can_update_podcast()
    {
        $post = factory(Podcast::class)->create();
        $data = [
            'name' => $this->faker->sentence,
            'feed_url' => $this->faker->url,
        ];
        $this->put(route('podcasts.update', $post->id), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    public function test_can_show_podcast()
    {
        $post = factory(Podcast::class)->create();
        $this->get(route('podcasts.show', $post->id))
            ->assertStatus(200);
    }

    public function test_can_delete_post() {
        $post = factory(Podcast::class)->create();
        $this->delete(route('podcasts.delete', $post->id))
            ->assertStatus(204);
    }

}
