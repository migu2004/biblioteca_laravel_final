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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            // Relación con libros y usuarios (lectores)
            $table->foreignId('libro_id')->constrained('libros');
            $table->foreignId('user_id')->constrained('users');
            $table->date('fecha_prestamo');
            $table->string('estado')->default('prestado'); // 'prestado' o 'devuelto'
            $table->timestamps();
        });
    }
        /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
