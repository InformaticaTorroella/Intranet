<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Crear Categoria</title>
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
</head>
<body>
<x-header />

<main class="categories-page-center">
    <div class="categories-container">
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

        <form action="{{ route('categoria-noticias.store') }}" method="POST" class="category-form">
            @csrf

            <label for="nom">Nom de la Categoria:</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('categoria-noticias.index') }}" class="btn btn-primary">Tornar</a>
            </div>

        </form>
    </div>
</main>

<x-footer />
</body>
</html>
