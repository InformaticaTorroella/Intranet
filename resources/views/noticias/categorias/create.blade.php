<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Crear Categoria</title>
    <link rel="stylesheet" href="{{ asset('css/noticias.css') }}">
</head>
<body>
<x-header />

<main>
    <h1>Crear Categoria</h1>

    @if ($errors->any())
        <div class="form-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <label for="nom">Nom de la Categoria:</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('categories.index') }}" class="btn-go-back">Tornar</a>
    </form>
</main>

<x-footer />
</body>
</html>