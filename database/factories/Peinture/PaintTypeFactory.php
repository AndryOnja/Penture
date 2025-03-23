<?php

namespace Database\Factories\Peinture;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peinture\PaintType>
 */
class PaintTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['à l\'eau', 'à l\'huile', 'antirouille', 'enduit'];

        return [
            'name' => $this->faker->unique()->randomElement($types),
            'description' => $this->faker->paragraph(),
        ];
    }

    // À l'eau
    public function waterBased()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'à l\'eau',
                'description' => 'Peinture à base d\'eau, séchage rapide et nettoyage facile.',
            ];
        });
    }

    // À l'huile
    public function oilBased()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'à l\'huile',
                'description' => 'Peinture traditionnelle à base d\'huile, durable et résistante.',
            ];
        });
    }

    // Antirouille
    public function rustproof()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'antirouille',
                'description' => 'Peinture conçue pour protéger les surfaces métalliques de la corrosion.',
            ];
        });
    }

    // Enduit
    public function coating()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'enduit',
                'description' => 'Préparation pour lisser et uniformiser les surfaces avant peinture.',
            ];
        });
    }
}
