<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

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
            'village_id' => Village::all()->random()->id,
            'name' => $this->faker->randomElement(['Home', 'Office', 'Hotel', 'Kost']),
            'address' => $this->faker->streetAddress,
            'status' => 1,
        ];
    }
}
