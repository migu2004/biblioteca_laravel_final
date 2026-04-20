<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Préstamo - Biblioteca CIAF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #2563eb; border: none; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h2 class="text-center mb-4">📦 Registrar Préstamo</h2>
                <hr>

                @if($errors->has('error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('error') }}
                    </div>
                @endif

                <form action="{{ route('prestamos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">¿Qué libro se van a llevar?</label>
                        <select name="libro_id" class="form-select" required>
                            <option value="" selected disabled>Selecciona un libro...</option>
                            @foreach($libros as $libro)
                                <option value="{{ $libro->id }}">{{ $libro->titulo }} (ISBN: {{ $libro->isbn }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">¿Quién se lo lleva? (Usuario)</label>
                        <select name="user_id" class="form-select" required>
                            <option value="" selected disabled>Selecciona un usuario...</option>
                            @foreach($usuarios as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Confirmar Préstamo</button>
                        <a href="{{ route('libros.index') }}" class="btn btn-light">Volver al Inventario</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>