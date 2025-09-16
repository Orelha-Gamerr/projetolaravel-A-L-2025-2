<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carro>
 */
class CarroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'placa' => strtoupper($this->faker->randomElement([
            $this->faker->bothify('???-####'),   // Antiga: ABC-1234
            $this->faker->bothify('???-#?##'),    // Mercosul: BRA2E19
            ])),
            'marca' => $this->faker->randomElement(['Toyota', 'Ford', 'Chevrolet', 'Honda', 'Nissan', 'Volkswagen', 'Hyundai']),
            'modelo' => $this->faker->word,
            'ano' => $this->faker->numberBetween(1950, 2025),
            'renavam' => $this->faker->unique()->numerify('###########'),
        ];
    }
}