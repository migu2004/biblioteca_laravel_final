<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    
    protected $fillable = ['titulo', 'autor', 'isbn', 'cantidad'];

    
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}