<?php

namespace Database\Factories\Peinture;

use App\Models\Peinture\PaintType;
use App\Models\Peinture\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peinture\Formula>
 */
class FormulaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'paint_type_id' => PaintType::factory(),
            'ingredient_id' => Ingredient::factory(),
            'ratio' => $this->faker->randomFloat(2, 5, 60),
            'is_required' => $this->faker->boolean(80), // 80% chance d'être requis
            'min_percentage' => function (array $attributes) {
                return $attributes['ratio'] * 0.7; // 70% du ratio comme minimum
            },
            'max_percentage' => function (array $attributes) {
                return $attributes['ratio'] * 1.3; // 130% du ratio comme maximum
            },
        ];
    }
}
