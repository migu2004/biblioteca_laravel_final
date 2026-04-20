<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Traemos los libros y contamos solo los préstamos que NO se han devuelto
        $libros = \App\Models\Libro::withCount(['prestamos as prestados' => function ($query) {
            $query->where('estado', 'prestado');
        }])->get();
        
        $prestamosActivos = \App\Models\Prestamo::where('estado', 'prestado')
                            ->with(['libro', 'user'])
                            ->get();

        return view('libros.index', compact('libros', 'prestamosActivos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    Public function store(Request $request)
    {
    // Validamos los datos que vienen del formulario 
        $data = $request->validate([
            'titulo'   => 'required|string|max:255',
            'autor'    => 'required|string|max:255',
            'isbn'     => 'required|integer|unique:libros,isbn',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Creamos el libro en la base de datos
        Libro::create($data);

        // Redirigimos al inventario 
        return redirect()->route('libros.index')->with('success', 'Libro guardado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {
        // Laravel hace la búsqueda automática 
        return view('libros.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        $data = $request->validate([
            'titulo'   => 'required|string|max:255',
            'autor'    => 'required|string|max:255',
            'isbn'     => 'required|string|unique:libros,isbn,' . $libro->id, 
            'cantidad' => 'required|integer|min:0',
        ]);

        $libro->update($data);

        return redirect()->route('libros.index')->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $libro = \App\Models\Libro::findOrFail($id);

        // 1. Revisar si hay préstamos ACTIVOS
        $prestamosActivos = \App\Models\Prestamo::where('libro_id', $id)
                                ->where('estado', 'prestado')
                                ->count();

        if ($prestamosActivos > 0) {
            // Si alguien lo tiene ahorita, detenemos la eliminación
            return back()->withErrors(['error' => 'No puedes borrar el libro "' . $libro->titulo . '" porque alguien lo tiene prestado actualmente.']);
        }

        // 2. Aplicar la Opción B: Borrar el historial de préstamos pasados
        \App\Models\Prestamo::where('libro_id', $id)->delete();

        // 3. Ahora sí, borrar el libro de forma segura
        $libro->delete();

        return redirect()->route('libros.index')->with('success', 'El libro fue eliminado correctamente. ');
    }
}
