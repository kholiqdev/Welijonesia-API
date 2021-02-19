<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Order;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'user_id' => User::factory(),
            'seller_id' => Seller::factory(),
            'address_id' => Address::factory(),
            'order_at' => $this->faker->dateTimeBetween('-1 years', now()),
            'expire_at' => $this->faker->dateTimeInInterval(now(), '+1 days'),
            'status' => $this->faker->randomElement([0, 1, 2, 3, 4, 5])
        ];
    }
}
