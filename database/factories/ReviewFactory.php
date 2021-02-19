<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Review;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

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
            'product_id' => Product::factory(),
            'seller_id' => Seller::factory(),
            'picturePath' => $this->faker->md5 . '.png',
            'rate' => $this->faker->numberBetween(0, 5),
            'text' => $this->faker->realText()
        ];
    }
}
