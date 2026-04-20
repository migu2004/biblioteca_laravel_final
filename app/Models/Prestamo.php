<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = ['libro_id', 'user_id', 'fecha_prestamo', 'estado'];  

    // Un préstamo pertenece a un Libro
    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }

    // Un préstamo pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}