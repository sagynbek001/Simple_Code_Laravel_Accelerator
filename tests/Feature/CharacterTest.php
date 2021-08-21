<?php

namespace Tests\Feature;

use App\Models\Character;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CharacterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validation()
    {
        $response = $this->postJson('/api/v1/characters', []);
        $response->assertStatus(422)->assertJsonStructure([
            'message', 'errors' => ['name', 'status', 'gender', 'race', 'description', 'image_id']
        ]);
    }

    public function test_store()
    {
        $model = Character::factory()->raw();
        $response = $this->postJson('/api/v1/characters', $model);
        $this->assertDatabaseHas('characters', $model);
        $response->assertStatus(200)->assertJson(['message' => 'Персонаж сохранен']);
    }

    public function test_destroy()
    {
        $model = Character::factory()->create();

        $response = $this->deleteJson('/api/v1/characters' . $model->id);
        $response->assertStatus(200)->assertJson(['message' => 'Персонаж удален']);
        $this->assertSoftDeleted('characters', $model->toArray());
    }

    public function test_update()
    {
        $model1 = Character::factory()->create();
        $model2 = Character::factory()->raw();

        $response = $this->putJson('/api/v1/characters' . $model1->id, $model2);
        $response->assertStatus(200)->assertJson(['message' => 'Персонаж сохранен']);
        $this->assertDatabaseHas('characters', $model2);
    }
}
