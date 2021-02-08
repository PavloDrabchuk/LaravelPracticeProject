<?php

namespace Database\Factories;

use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Price::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->numberBetween(1, 190),
            //'currency' => $this->faker->randomElement(['UAH', 'USD']),
            'currency_id' => $this->faker->numberBetween(1,3),
            'product_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
