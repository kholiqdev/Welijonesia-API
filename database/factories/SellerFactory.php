<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seller::class;

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
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(['keliling', 'mangkal', 'campuran']),
            'picturePath' => $this->faker->imageUrl(240, 240, 'foods'),
            'rate' => $this->faker->numberBetween(0, 5),
            'favorit' => $this->faker->numberBetween(10, 1000),
            'active' => 1,
        ];
    }
}
