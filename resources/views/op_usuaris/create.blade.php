<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuari</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/op.css') }}">
</head>
<body>
  <x-header />

    <div class="container">
        <h1 class="page-title">Crear Usuari</h1>

        <form action="{{ route('op_usuaris.store') }}" method="POST" class="form-grid">
            @csrf

            <div class="mb-4">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" id="nom" class="form-select" value="{{ old('nom') }}" required>
                @error('nom') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Crear</button>
        </form>

        <p><a href="{{ route('op_usuaris.index') }}" class="btn btn-secondary">Tornar enrere</a></p>
    </div>
    <x-footer />
</body>
</html>
