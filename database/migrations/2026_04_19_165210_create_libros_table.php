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
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');        // Título del libro
            $table->string('autor');         // Quién lo escribió
            $table->string('isbn')->unique(); // Código único del libro
            $table->integer('cantidad');     // Cuántos hay en estante
            $table->text('descripcion')->nullable(); // Resumen opcional
            $table->timestamps();            // Fecha de creación/edición
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
