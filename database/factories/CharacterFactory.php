<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statuses = ["dead", "alive"];
        $genders = ["male", "female"];
        $races = ["human", "alien", "animal"];
        shuffle($statuses);
        shuffle($genders);
        shuffle($races);
        return [
            'name' => $this->faker->name(),
            'status' => $statuses[0],
            'gender' => $genders[0],
            'race' => $races[0],
            'description' => Str::random(10),
        ];
    }
}
