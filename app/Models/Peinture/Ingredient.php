<?php

namespace App\Models\Peinture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\Peinture\IngredientFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'density',
        'unit'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function formulas(): HasMany
    {
        return $this->hasMany(Formula::class);
    }
}
