<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nombre del equipo
            $table->string('label')->default('Sin etiqueta'); // etiqueta, valor por defecto
            $table->text('description')->nullable(); // descripción, puede ser null
            $table->string('brand')->nullable(); // marca, puede ser null
            $table->timestamps();
            $table->softDeletes(); // columna deleted_at para soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
