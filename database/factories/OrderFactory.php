<?php

namespace Database\Factories;

use App\Models\Billing;
use App\Models\Order;
use App\Models\Seller;
use App\Models\User;
use App\Models\Village;
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
            'billing_id' => Billing::factory(),
            'shipping_method' => $this->faker->randomElement([0, 1]),
            'village_id' => Village::all()->random()->id,
            'customer_addressName' => $this->faker->randomElement(['Home', 'Office', 'Hotel', 'Kost']),
            'customer_address' => $this->faker->streetAddress,
            'order_at' => $this->faker->dateTimeBetween('-1 years', now()),
            'expire_at' => $this->faker->dateTimeInInterval(now(), '+1 days'),
            'status' => $this->faker->randomElement([0, 1, 2, 3, 4, 5])
        ];
    }
}
