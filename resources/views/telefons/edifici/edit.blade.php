<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Edifici</title>
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
</head>
<body>
<x-header />

<main class="categories-page-center">
    <div class="categories-container">
        <h1>Editar Edifici</h1>

        @if ($errors->any())
            <div class="category-error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('edifici-telefons.update', $equipament->id_equimanent) }}" method="POST" class="category-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="Equipament">Nom de l'Edifici:</label>
                <input type="text" name="Equipament" id="Equipament" value="{{ old('Equipament', $equipament->Equipament) }}" required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-primary">Guardar</button>
                <a href="{{ route('edifici-telefons.index') }}" class="btn-primary">Tornar</a>
            </div>
        </form>
    </div>
</main>

<x-footer />
</body>
</html>
