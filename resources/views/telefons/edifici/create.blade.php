<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Crear Edifici</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
</head>
<body>
<x-header />

<main class="categories-page-center">
    <div class="categories-container">
        <h1>Crear Edifici</h1>

        @if ($errors->any())
            <div class="form-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('edifici-telefons.store') }}" method="POST" class="category-form">
            @csrf
            <!-- Equipament es el nom que hi ha a la db -->
            <label for="Equipament">Nom del Edifici:</label>
            <input type="text" id="Equipament" name="Equipament" value="{{ old('Equipament') }}" required>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('edifici-telefons.index') }}" class="btn btn-primary">Tornar</a>
            </div>
        </form>
    </div>
</main>

<x-footer />
</body>
</html>
