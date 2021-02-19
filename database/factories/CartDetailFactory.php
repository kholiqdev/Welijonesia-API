<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CartDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'cart_id' => Cart::factory(),
            'product_detail_id' => ProductDetail::factory(),
            'quantity' => $this->faker->numberBetween(1, 20),
            'subtotal' => $this->faker->randomNumber()
        ];
    }
}
