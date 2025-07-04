<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <title>Editar Categoria</title>
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
</head>
<body>
<x-header />

<main class="categories-page-center">
    <div class="categories-container">
        <h1>Editar Categoria</h1>

        @if ($errors->any())
            <div class="form-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categoria-documents.update', $categoria->id) }}" method="POST" class="category-form">
            @csrf
            @method('PUT')

            <label for="nom">Nom de la Categoria:</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $categoria->nom) }}" required>

            <div class="form-buttons">
                <button type="submit" class="btn-primary">Guardar</button>
                <a href="{{ route('categoria-documents.index') }}" class="btn-primary">Tornar</a>
            </div>
        </form>
    </div>
</main>

<x-footer />
</body>
</html>
