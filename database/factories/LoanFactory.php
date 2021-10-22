<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\Model;
use App\Models\Options\Service;
use App\Models\Options\Trade;
use App\Models\Product;
use App\Nova\Options\Agriculture;
use App\Nova\Options\Consumption;
use App\Nova\Options\Transportation;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Loan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => 158,
            'product_id' => $this->faker->numberBetween(1,100),
            'percentage' => '34',
            'month' => $this->faker->randomDigit(),
            'price' => $this->faker->numberBetween(100,10000),
            'collateral_name' => $this->faker->word,
            'trick_id' => 1,
            'gram' => $this->faker->randomDigit(),
            'collateral_price' => $this->faker->numberBetween(100,10000),
            "status" => $this->faker->numberBetween(0,1),
            "approved" => $this->faker->numberBetween(0,1),
            'consumption_id' => 1,
            'production_id' => 1,
            'agriculture_id' => 1,
            'trade_id' => 1,
            'service_id' => 1,
            'transportation_id' => 1,
            'user_id' => $this->faker->numberBetween(1,100),
        ];
    }
}
