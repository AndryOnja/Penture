<?php

namespace App\Models\Peinture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaintType extends Model
{
    /** @use HasFactory<\Database\Factories\Peinture\PaintTypeFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function formulas(): HasMany
    {
        return $this->hasMany(Formula::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'formulas')
                    ->withPivot('ratio', 'is_required', 'min_percentage', 'max_percentage');
    }
}
