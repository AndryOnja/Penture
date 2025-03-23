<?php

namespace Database\Factories\Peinture;

use App\Models\Peinture\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peinture\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $units = ['g', 'ml', 'kg', 'l'];

        return [
            'name' => $this->faker->unique()->word(),
            'category_id' => Category::factory(),
            'description' => $this->faker->sentence(15),
            'density' => $this->faker->randomFloat(2, 0.5, 5.0),
            'unit' => $this->faker->randomElement($units),
        ];
    }

    public function pigment()
    {
        return $this->state(function (array $attributes) {
            return [
                'category_id' => Category::where('name', 'Pigment')->first()->id ?? 1,
                'unit' => 'g',
            ];
        });
    }

    // Charges
    public function charge()
    {
        return $this->state(function (array $attributes) {
            return [
                'category_id' => Category::where('name', 'Charge')->first()->id ?? 2,
                'unit' => 'g',
            ];
        });
    }

    // Liants
    public function liant()
    {
        return $this->state(function (array $attributes) {
            return [
                'category_id' => Category::where('name', 'Liant')->first()->id ?? 3,
                'unit' => 'ml',
            ];
        });
    }

    // Solvants
    public function solvant()
    {
        return $this->state(function (array $attributes) {
            return [
                'category_id' => Category::where('name', 'Solvant')->first()->id ?? 4,
                'unit' => 'ml',
            ];
        });
    }

    public function additif()
    {
        return $this->state(function (array $attributes) {
            return [
                'category_id' => Category::where('name', 'Additif')->first()->id ?? 5,
                'unit' => 'ml',
            ];
        });
    }
}
