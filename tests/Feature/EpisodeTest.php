<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EpisodeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validation()
    {
        $response = $this->postJson('/api/v1/episodes', []);
        $response->assertStatus(422)->assertJsonStructure([
            'message', 'errors' => ['name', 'season', 'series', 'premiere', 'description']
        ]);
    }
}
