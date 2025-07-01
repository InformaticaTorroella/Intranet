<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Editar Circular</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/circulars.css') }}">
</head>
<body>
    <x-header />

    <div class="circulars-page-center">
        <div class="circulars-container">
            <h1 class="form-title">Editar Circular</h1>

            <form action="{{ route('circulars.update', $circular->id) }}" method="POST" class="circulars-form">
                @csrf
                @method('PUT')

                <label for="nom_visual">Nom Visual:</label>
                <input type="text" name="nom_visual" id="nom_visual" maxlength="200" required value="{{ old('nom_visual', $circular->nom_visual) }}">

                <label for="nom_arxiu">Nom Arxiu:</label>
                <input type="text" name="nom_arxiu" id="nom_arxiu" maxlength="200" value="{{ old('nom_arxiu', $circular->nom_arxiu) }}">

                <label for="data_creacio">Data Creació:</label>
                <input type="datetime-local" name="data_creacio" id="data_creacio" required value="{{ old('data_creacio', \Carbon\Carbon::parse($circular->data_creacio)->format('Y-m-d\TH:i')) }}">

                <label for="data_edicio">Data Edició:</label>
                <input type="datetime-local" name="data_edicio" id="data_edicio" value="{{ old('data_edicio', $circular->data_edicio ? \Carbon\Carbon::parse($circular->data_edicio)->format('Y-m-d\TH:i') : '') }}">

                <label for="data_publicacio">Data Publicació:</label>
                <input type="datetime-local" name="data_publicacio" id="data_publicacio" value="{{ old('data_publicacio', $circular->data_publicacio ? \Carbon\Carbon::parse($circular->data_publicacio)->format('Y-m-d\TH:i') : '') }}">

                <label for="extensio">Extensió:</label>
                <input type="text" name="extensio" id="extensio" maxlength="10" value="{{ old('extensio', $circular->extensio) }}">

                <label for="ordre">Ordre:</label>
                <input type="number" name="ordre" id="ordre" required value="{{ old('ordre', $circular->ordre) }}">

                <label for="url">URL:</label>
                <input type="text" name="url" id="url" maxlength="255" value="{{ old('url', $circular->url) }}">

                <select name="publicat" id="publicat">
                    <option value="0" {{ old('publicat', $circular->publicat) == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('publicat', $circular->publicat) == 1 ? 'selected' : '' }}>Sí</option>
                </select>

                <label for="fk_cat_circular">Categoria:</label>
                <select name="fk_cat_circular" id="fk_cat_circular" required>
                    <option value="">-- Selecciona categoria --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('fk_cat_circular', $circular->fk_cat_circular) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nom }}
                        </option>
                    @endforeach
                </select>

                <button type="submit">Guardar</button>
                <a href="{{ route('circulars.index') }}" class="btn-go-back">Tornar</a>
            </form>
        </div>
    </div>

    <x-footer />

</body>
</html>