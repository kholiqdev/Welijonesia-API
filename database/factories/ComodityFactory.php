<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Comodity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComodityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comodity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'category_id' => Category::factory(),
            'name' => $this->faker->name,
            'picturePath' => $this->faker->md5 . '.png',
        ];
    }
}
