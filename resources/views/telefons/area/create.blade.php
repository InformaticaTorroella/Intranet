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

            <label for="Area">Nom de la Area:</label>
            <input type="text" id="Area" name="Area" value="{{ old('Area') }}" required>

            <label for="id_equimanent">Edifici:</label>
            <select id="id_equimanent" name="id_equimanent" required>
                <option value="" disabled selected>Selecciona un edifici</option>
                @foreach ($edificis as $edifici)
                    <option value="{{ $edifici->id_equimanent }}" {{ old('id_equimanent') == $edifici->id_equimanent ? 'selected' : '' }}>
                        {{ $edifici->Equipament }}
                    </option>
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
