<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validation()
    {
        $response = $this->postJson('/api/v1/images', []);
        $response->assertStatus(422)->assertJsonStructure([
            'message', 'errors' => ['file']
        ]);
    }
}
