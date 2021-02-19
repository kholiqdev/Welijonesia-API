<?php

namespace Database\Factories;

use App\Models\Comodity;
use App\Models\ComodityDetail;
use App\Models\ProductUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComodityDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ComodityDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'comodity_id' => Comodity::factory(),
            'product_unit_id' => ProductUnit::factory(),
            'amount' => $this->faker->randomNumber(),
            'price' => $this->faker->randomNumber()
        ];
    }
}
