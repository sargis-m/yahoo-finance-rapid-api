<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition()
    {
        return [
            'symbol' => $this->faker->unique()->word,
            'full_exchange_name' => $this->faker->company,
            'latest_close' => $this->faker->randomFloat(2, 10, 500),
            'previous_close' => $this->faker->randomFloat(2, 10, 500),
            'price_change' => $this->faker->randomFloat(2, 10, 500),
            'regular_market_time' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
