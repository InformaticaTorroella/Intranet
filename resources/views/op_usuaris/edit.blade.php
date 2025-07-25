<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuari #{{ $op_usuari->id }}</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/op.css') }}">
</head>
<body>
    <x-header />

    <div class="container">
        <h1 class="page-title">Editar Usuari #{{ $op_usuari->id }}</h1>

        <form action="{{ route('op_usuaris.update', $op_usuari) }}" method="POST" class="form-grid">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" id="nom" class="form-select" value="{{ old('nom', $op_usuari->nom) }}" required>
                @error('nom') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Actualitzar</button>
        </form>

        <p><a href="{{ route('op_usuaris.index') }}" class="btn btn-secondary">Tornar enrere</a></p>
    </div>
    <x-footer />
</body>
</html>
