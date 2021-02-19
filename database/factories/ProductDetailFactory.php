<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'product_id' => Product::factory(),
            'product_unit_id' => ProductUnit::factory(),
            'amount' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->randomNumber(6),
        ];
    }
}
