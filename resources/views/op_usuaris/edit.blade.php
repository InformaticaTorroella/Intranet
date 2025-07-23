<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuari #{{ $op_usuari->id }}</title>
</head>
<body>
    <h1>Editar Usuari #{{ $op_usuari->id }}</h1>

    <form action="{{ route('op_usuaris.update', $op_usuari) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nom:</label><br>
        <input type="text" name="nom" value="{{ old('nom', $op_usuari->nom) }}" required>
        @error('nom') <div style="color:red;">{{ $message }}</div> @enderror

        <br><br>
        <button type="submit">Actualitzar</button>
    </form>

    <p><a href="{{ route('op_usuaris.index') }}">Tornar enrere</a></p>
</body>
</html>
