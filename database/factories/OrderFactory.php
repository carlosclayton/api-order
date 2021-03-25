<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => "{$this->faker->year}-{$this->faker->month}-{$this->faker->uuid}",
            'total' => $this->faker->numberBetween(10, 1000),
            'discount' => $this->faker->numberBetween(10, 100),
            'customer_id' => Customer::factory()->create(),
        ];
    }
}
