<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Document</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/documents.css') }}">
</head>
<body>
    <x-header />
    <h1>Crear Document</h1>
    <form action="{{ route('documents.store') }}" method="POST">
        @csrf

        <label>Nom Visual:</label>
        <input type="text" name="nom_visual" value="{{ old('nom_visual') }}" required>

        <label>Nom Arxiu:</label>
        <input type="text" name="nom_arxiu" value="{{ old('nom_arxiu') }}">

        <label>Data Entrada:</label>
        <input type="datetime-local" name="data_entrada" value="{{ old('data_entrada') }}" required>

        <label>Extensió:</label>
        <input type="text" name="extensio" value="{{ old('extensio') }}" maxlength="10">

        <label>Ordre:</label>
        <input type="number" name="ordre" value="{{ old('ordre') }}" required>

        <label>URL Document:</label>
        <input type="text" name="url" value="{{ old('url') }}">

        <label>FK id Objecte:</label>
        <input type="number" name="fk_id_obj" value="{{ old('fk_id_obj') }}" required>

        <label>FK id Tipus Objecte:</label>
        <input type="number" name="fk_id_tipus_obj" value="{{ old('fk_id_tipus_obj') }}" required>

        <button type="submit" class="btn-primary">Crear</button>
    </form>
    <x-footer />
</body>
</html>
