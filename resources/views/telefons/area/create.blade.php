<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Crear Area</title>
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
</head>
<body>
<x-header />

<main class="categories-page-center">
    <div class="categories-container">
        <h1>Crear Area</h1>

        @if ($errors->any())
            <div class="form-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('area-telefons.store') }}" method="POST" class="category-form">
            @csrf

            <label for="nom">Nom de la Area:</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
            <label for="fk-edifici">Edifici:</label>
            <select id="fk-edifici" name="fk-edifici" required>
                <option value=""disabled>Selecciona un edifici</option>
                @foreach ($edificis as $edifici)
                    <option value="{{ $edifici->id_equipament }}" {{ old('fk-edifici') == $edifici->id ? 'selected' : '' }}>{{ $edifici->equipament }}</option>
                @endforeach
            </select>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('area-telefons.index') }}" class="btn btn-primary">Tornar</a>
            </div>

        </form>
    </div>
</main>

<x-footer />
</body>
</html>
