<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Libro - Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 600px;">
    <div class="card p-4 shadow-sm">
        <h3>Editar: {{ $libro->titulo }}</h3>
        <form action="{{ route('libros.update', $libro->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-3">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" value="{{ $libro->titulo }}" required>
            </div>

            <div class="mb-3">
                <label>Autor</label>
                <input type="text" name="autor" class="form-control" value="{{ $libro->autor }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="{{ $libro->isbn }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Stock</label>
                    <input type="number" name="cantidad" class="form-control" value="{{ $libro->cantidad }}" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Actualizar Cambios</button>
            <a href="{{ route('libros.index') }}" class="btn btn-link w-100 mt-2">Cancelar</a>
        </form>
    </div>
</div>
</body>
</html>