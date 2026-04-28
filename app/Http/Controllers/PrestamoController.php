<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Libro;
use App\Models\User;

class PrestamoController extends Controller
{
    public function create() 
    {
        $libros = Libro::all();
        $usuarios = User::all();
        return view('prestamos.create', compact('libros', 'usuarios'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'libro_id' => 'required',
            'user_id' => 'required',
        ]);

        // buscamos el libro para saber cuanto hay en su stock total
        $libro = Libro::findOrFail($request->libro_id);

        // Contamos los libros que están prestados
        $prestamosActivos = Prestamo::where('libro_id', $request->libro_id)
                        ->where('estado', 'prestado')
                        ->count();

        // Verificamos stock total
        if ($prestamosActivos >= $libro->cantidad) {
            return back()->withErrors(['error' => '¡Lo sentimos! Ya no quedan copias disponibles de este libro.']);
        }

        // Si la matemática nos da luz verde, creamos el préstamo
        Prestamo::create([
            'libro_id' => $request->libro_id,
            'user_id' => $request->user_id,
            'fecha_prestamo' => now(),
            'estado' => 'prestado',
        ]);

        return redirect()->route('libros.index')->with('success', 'Préstamo realizado con éxito.');
    }


    public function devolver($id)
    {
         
        $prestamo = \App\Models\Prestamo::findOrFail($id);

        
        $prestamo->update(['estado' => 'devuelto']);

        $libro = $prestamo->libro;

        return back()->with('success', 'Libro devuelto. El stock se ha actualizado.');
    }
}