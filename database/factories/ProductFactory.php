<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => [
                'ua' => 'ua-' . $this->faker->word,
                'en' => 'en-' . $this->faker->word,
                'ru' => 'ru-' . $this->faker->word,
            ],
            'category_id' => $this->faker->numberBetween(1, 13),
            'quantity' => $this->faker->numberBetween(0, 150),
            'article' => $this->faker->unique()->regexify('[a-zA-Z]{2}[0-9]{2}[a-zA-Z]{1}[0-9]{1}'),
            'color_id' => $this->faker->numberBetween(1, 12),
            //'price_id' => $this->faker->numberBetween(1, 12),
        ];
    }
}
