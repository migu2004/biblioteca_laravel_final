<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Biblioteca</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; background: #f4f4f4; }
        .login-card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; margin-bottom: 1rem; padding: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; font-size: 0.8rem; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Biblioteca CIAF</h2>
        
        @if ($errors->any())
            <div class="error">Datos incorrectos. Intenta de nuevo.</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf <label>Correo Electrónico:</label>
            <input type="email" name="email" required placeholder="admin@biblioteca.com">

            <label>Contraseña:</label>
            <input type="password" name="password" required>

            <button type="submit">Ingresar al Sistema</button>
        </form>
    </div>
</body>
</html>