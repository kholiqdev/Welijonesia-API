<?php

namespace Database\Factories;

use App\Models\Comodity;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

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
            'seller_id' => Seller::factory(),
            'description' => $this->faker->text
        ];
    }
}
