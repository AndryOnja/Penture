<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peinture\Formula;
use App\Models\Peinture\Category;
use App\Models\Peinture\PaintType;
use App\Models\Peinture\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer les catégories
        $pigmentCat = Category::factory()->create(['name' => 'Pigment', 'description' => 'Substances qui donnent la couleur']);
        $chargeCat = Category::factory()->create(['name' => 'Charge', 'description' => 'Substances qui donnent du volume et de la texture']);
        $liantCat = Category::factory()->create(['name' => 'Liant', 'description' => 'Substances qui lient les composants ensemble']);
        $solvantCat = Category::factory()->create(['name' => 'Solvant', 'description' => 'Substances qui diluent la peinture']);
        $additifCat = Category::factory()->create(['name' => 'Additif', 'description' => 'Substances qui modifient les propriétés']);

        // Créer des ingrédients par catégorie
        $titanium = Ingredient::factory()->create([
            'name' => 'Oxyde de titane',
            'category_id' => $pigmentCat->id,
            'description' => 'Pigment blanc très couvrant',
            'density' => 4.23,
            'unit' => 'g'
        ]);

        $calcium = Ingredient::factory()->create([
            'name' => 'Carbonate de calcium',
            'category_id' => $chargeCat->id,
            'description' => 'Charge minérale courante',
            'density' => 2.71,
            'unit' => 'g'
        ]);

        $linseed = Ingredient::factory()->create([
            'name' => 'Huile de lin',
            'category_id' => $liantCat->id,
            'description' => 'Liant traditionnel pour peinture à l\'huile',
            'density' => 0.93,
            'unit' => 'ml'
        ]);

        $water = Ingredient::factory()->create([
            'name' => 'Eau',
            'category_id' => $solvantCat->id,
            'description' => 'Solvant pour peintures à l\'eau',
            'density' => 1.0,
            'unit' => 'ml'
        ]);

        $turpentine = Ingredient::factory()->create([
            'name' => 'Essence de térébenthine',
            'category_id' => $solvantCat->id,
            'description' => 'Solvant traditionnel pour peintures à l\'huile',
            'density' => 0.87,
            'unit' => 'ml'
        ]);

        $drier = Ingredient::factory()->create([
            'name' => 'Siccatif',
            'category_id' => $additifCat->id,
            'description' => 'Accélère le séchage des peintures à l\'huile',
            'density' => 0.96,
            'unit' => 'ml'
        ]);

        // Créer les types de peinture
        $waterPaint = PaintType::factory()->create([
            'name' => 'à l\'eau',
            'description' => 'Peinture diluable à l\'eau, séchage rapide'
        ]);

        $oilPaint = PaintType::factory()->create([
            'name' => 'à l\'huile',
            'description' => 'Peinture traditionnelle à base d\'huile'
        ]);

        $rustPaint = PaintType::factory()->create([
            'name' => 'antirouille',
            'description' => 'Protection contre la corrosion'
        ]);

        $coatingPaint = PaintType::factory()->create([
            'name' => 'enduit',
            'description' => 'Préparation des surfaces'
        ]);

        // Formules pour peinture à l'eau
        Formula::factory()->create([
            'paint_type_id' => $waterPaint->id,
            'ingredient_id' => $titanium->id,
            'ratio' => 25.00,
            'is_required' => true,
            'min_percentage' => 20.00,
            'max_percentage' => 35.00
        ]);

        Formula::factory()->create([
            'paint_type_id' => $waterPaint->id,
            'ingredient_id' => $calcium->id,
            'ratio' => 15.00,
            'is_required' => true,
            'min_percentage' => 10.00,
            'max_percentage' => 20.00
        ]);

        Formula::factory()->create([
            'paint_type_id' => $waterPaint->id,
            'ingredient_id' => $water->id,
            'ratio' => 60.00,
            'is_required' => true,
            'min_percentage' => 50.00,
            'max_percentage' => 70.00
        ]);

        // Formules pour peinture à l'huile
        Formula::factory()->create([
            'paint_type_id' => $oilPaint->id,
            'ingredient_id' => $titanium->id,
            'ratio' => 30.00,
            'is_required' => true,
            'min_percentage' => 20.00,
            'max_percentage' => 40.00
        ]);

        Formula::factory()->create([
            'paint_type_id' => $oilPaint->id,
            'ingredient_id' => $calcium->id,
            'ratio' => 15.00,
            'is_required' => true,
            'min_percentage' => 10.00,
            'max_percentage' => 20.00
        ]);

        Formula::factory()->create([
            'paint_type_id' => $oilPaint->id,
            'ingredient_id' => $linseed->id,
            'ratio' => 45.00,
            'is_required' => true,
            'min_percentage' => 40.00,
            'max_percentage' => 55.00
        ]);

        Formula::factory()->create([
            'paint_type_id' => $oilPaint->id,
            'ingredient_id' => $turpentine->id,
            'ratio' => 10.00,
            'is_required' => true,
            'min_percentage' => 5.00,
            'max_percentage' => 15.00
        ]);

    }
}
