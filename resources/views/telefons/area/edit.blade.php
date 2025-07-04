<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
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

        <form action="{{ route('area-telefons.update', $area->IdArea) }}" method="POST" class="category-form">
            @csrf
            @method('PUT')

            <label for="nom">Nom de la Categoria:</label>
            <input type="text" id="nom" name="Area" value="{{ old('Area', $area->Area) }}" required>

            <label for="fk-edifici">Edifici:</label>
            <select id="fk-edifici" name="id_equimanent" required class="form-select">
                <option value="" disabled>Selecciona un edifici</option>
                @foreach ($edificis as $edifici)
                    <option value="{{ $edifici->id_equimanent }}" {{ old('fk-edifici', $area->id_equimanent) == $edifici->id_equimanent ? 'selected' : '' }}>
                        {{ $edifici->Equipament }}
                    </option>
                @endforeach
            </select>

            <div class="form-buttons">
                <button type="submit" class="btn-primary">Guardar</button>
                <a href="{{ route('area-telefons.index') }}" class="btn-primary">Tornar</a>
            </div>
        </form>


    </div>
</main>

<x-footer />
</body>
</html>
