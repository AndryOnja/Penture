<?php

namespace App\Models\Peinture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Formula extends Model
{
    /** @use HasFactory<\Database\Factories\Peinture\FormulaFactory> */
    use HasFactory;

    protected $fillable = ['paint_type_id', 'ingredient_id', 'ratio', 'is_required', 'min_percentage', 'max_percentage'];

    public function paintType(): BelongsTo
    {
        return $this->belongsTo(PaintType::class);
    }

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }
}
