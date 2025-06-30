<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Crear Circular</title>
    <link rel="stylesheet" href="{{ asset('css/circulars.css') }}">
</head>
<body>
    <x-header />

    <div class="circulars-page-center">
        <div class="circulars-container">
            <h1 class="form-title">Crear Circular</h1>

            <form action="{{ route('circulars.store') }}" method="POST" enctype="multipart/form-data" class="circulars-form">
                @csrf

                <label for="file">Fitxer (pdf, doc, jpg...):</label>
                <input type="file" name="file" id="file" required>

                <label for="nom_visual">Nom Visual:</label>
                <input type="text" name="nom_visual" id="nom_visual" maxlength="200" required value="{{ old('nom_visual') }}">

                <label for="data_creacio">Data Creació:</label>
                <input type="datetime-local" name="data_creacio" id="data_creacio" required value="{{ old('data_creacio') }}">

                <label for="ordre">Ordre:</label>
                <input type="number" name="ordre" id="ordre" required value="{{ old('ordre') }}">

                <label for="fk_cat_circular">Categoria ID (fk_cat_circular):</label>
                <input type="number" name="fk_cat_circular" id="fk_cat_circular" required value="{{ old('fk_cat_circular') }}">

                <label for="fk_tipus_obj">Tipus Objecte (fk_tipus_obj):</label>
                <input type="number" name="fk_tipus_obj" id="fk_tipus_obj" required value="{{ old('fk_tipus_obj') }}">

                <label for="publicat">Publicat (0/1):</label>
                <input type="number" name="publicat" id="publicat" min="0" max="1" value="{{ old('publicat', 0) }}">

                <label for="trial689">Trial689:</label>
                <input type="text" name="trial689" id="trial689" maxlength="1" value="{{ old('trial689') }}">

                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>

    <x-footer />
</body>
</html>