<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formulas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paint_type_id')->constrained();
            $table->foreignId('ingredient_id')->constrained();
            $table->decimal('ratio', 8, 2); // Ratio ou pourcentage dans la formule
            $table->boolean('is_required')->default(true);
            $table->decimal('min_percentage', 5, 2)->nullable();
            $table->decimal('max_percentage', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulas');
    }
};
