<?php

namespace Tests\Feature;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validation()
    {
        $response = $this->postJson('/api/v1/locations', []);
        $response->assertStatus(422)->assertJsonStructure([
            'message', 'errors' => ['type', 'dimension', 'name', 'description', 'image_id']
        ]);
    }

    public function test_store()
    {
        $model = Location::factory()->raw();
        $response = $this->postJson('/api/v1/locations', $model);
        $this->assertDatabaseHas('locations', $model);
        $response->assertStatus(200)->assertJson(['message' => 'Локация сохранен']);
    }

    public function test_destroy()
    {
        $model = Location::factory()->create();

        $response = $this->deleteJson('/api/v1/locations' . $model->id);
        $response->assertStatus(200)->assertJson(['message' => 'Локация удалена']);
        $this->assertSoftDeleted('locations', $model->toArray());
    }

    public function test_update()
    {
        $model1 = Location::factory()->create();
        $model2 = Location::factory()->raw();

        $response = $this->putJson('/api/v1/locations' . $model1->id, $model2);
        $response->assertStatus(200)->assertJson(['message' => 'Локация сохранена']);
        $this->assertDatabaseHas('locations', $model2);
    }
}
