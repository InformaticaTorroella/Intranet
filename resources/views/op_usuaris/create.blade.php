<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuari</title>
</head>
<body>
    <h1>Crear Usuari</h1>

    <form action="{{ route('op_usuaris.store') }}" method="POST">
        @csrf

        <label>Nom:</label><br>
        <input type="text" name="nom" value="{{ old('nom') }}" required>
        @error('nom') <div style="color:red;">{{ $message }}</div> @enderror

        <br><br>
        <button type="submit">Crear</button>
    </form>

    <p><a href="{{ route('op_usuaris.index') }}">Tornar enrere</a></p>
</body>
</html>
