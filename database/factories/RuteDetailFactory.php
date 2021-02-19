<?php

namespace Database\Factories;

use App\Models\Rute;
use App\Models\RuteDetail;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

class RuteDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RuteDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'seller_id' => Seller::factory(),
            'rute_id' => Rute::factory(),
        ];
    }
}
