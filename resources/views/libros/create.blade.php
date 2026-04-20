<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Libro - Biblioteca CIAF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { margin-top: 50px; max-width: 600px; }
        .card { border: none; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); border-radius: 12px; }
        .btn-primary { background-color: #2563eb; border: none; }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <h2 class="text-center mb-4">Registrar Nuevo Libro</h2>
        <hr>

        @if ($errors->any())
            <div class="alert alert-danger">
                 <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('libros.store') }}" method="POST">
            @csrf <div class="mb-3">
                <label class="form-label">Título del Libro</label>
                <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" value="{{ old('autor') }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cantidad (Stock)</label>
                    <input type="number" name="cantidad" class="form-control" min="1" value="1" required>
                </div>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Guardar Libro</button>
                <a href="{{ route('libros.index') }}" class="btn btn-light">Cancelar y Volver</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>