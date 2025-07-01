<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Crear Circular</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/circulars.css') }}">
</head>
<body>
    <x-header />

    <!-- PER DEBUGEJAR EL ERROR DE PUJAR EL FITXER en el inspector del navegador el comentari es va actualitzant mostrant els errors
    {{-- Missatges d'error --}}
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Missatge d'èxit --}}
    @if (session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif
-->
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

            <label for="fk_cat_circular">Categoria:</label>
            <select name="fk_cat_circular" id="fk_cat_circular" required>
                <option value="">-- Selecciona categoria --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('fk_cat_circular') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nom }}
                    </option>
                @endforeach
            </select>

            <label for="publicat">Publicat:</label>
            <select name="publicat" id="publicat">
                <option value="0" {{ old('publicat', 0) == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('publicat', 0) == 1 ? 'selected' : '' }}>Sí</option>
            </select>

            <button type="submit">Guardar</button>
        </form>
    </div>
</div>

<x-footer />


</body>
</html>