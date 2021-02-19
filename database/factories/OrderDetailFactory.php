<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'product_detail_id' => ProductDetail::factory(),
            'order_id' => Order::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'subtotal' => $this->faker->randomNumber()
        ];
    }
}
