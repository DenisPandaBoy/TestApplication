<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vat = 21;
        $price = fake()->numberBetween(0,100);
        $price_vat = $price * ( 1 + $vat / 100.0);

        return [
            'name'=> fake()->randomElement(['kofola','banan','baklazan']),
            'count'=> fake()->numberBetween(0,100),
            'price'=> $price,
            'vat'=> $vat,
            'price_vat'=> $price_vat,
        ];
    }
}
