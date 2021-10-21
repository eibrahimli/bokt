<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "surname" => $this->faker->name(),
            "fathername" => $this->faker->name(),
            'fin' => $this->faker->numberBetween($min = 1000000, $max = 9000000),
            "identity_number" => $this->faker->randomDigit(),
            "registration_address" => $this->faker->sentence(4),
            "residential_address" => $this->faker->sentence(4),
            "contact_phone" => "+994 70 666 6666",
            "is_immigrant" => $this->faker->boolean,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'maritial_status' => $this->faker->randomElement(['married', 'single']),
            'user_id' => $this->faker->randomDigitNot(0)
        ];
    }
}
