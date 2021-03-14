<?php

namespace Database\Factories;

use App\Models\Billing;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Billing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'payment_method_id' => PaymentMethod::factory(),
            'picturePath' => $this->faker->md5 . '.png',
            'total' => $this->faker->randomNumber(8),
            'status' => $this->faker->randomElement([0, 1, 2]),
        ];
    }
}
