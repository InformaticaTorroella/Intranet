<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Notícia</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/noticias.css') }}">
</head>
<body>
    <h1>Crear Notícia</h1>
    <form action="{{ route('noticias.store') }}" method="POST">
        @csrf

        <label>Nom:</label>
        <input type="text" name="nom_noticia" value="{{ old('nom_noticia') }}" required>

        <label>Descripció:</label>
        <textarea name="descripcio_noticia" required>{{ old('descripcio_noticia') }}</textarea>

        <label>Data de publicació:</label>
        <input type="datetime-local" name="data_pub" value="{{ old('data_pub') }}" required>

        <label>Publicat:</label>
        <select name="bool_pub" required>
            <option value="1" {{ old('bool_pub') == '1' ? 'selected' : '' }}>Sí</option>
            <option value="0" {{ old('bool_pub') == '0' ? 'selected' : '' }}>No</option>
        </select>

        <label>URL document:</label>
        <input type="text" name="url_document" value="{{ old('url_document') }}">

        <label>Data inicial:</label>
        <input type="date" name="data_inicial" value="{{ old('data_inicial') }}" required>

        <label>Data final:</label>
        <input type="date" name="data_final" value="{{ old('data_final') }}" required>

        <button type="submit" class="btn-primary">Crear</button>
    </form>
</body>
</html>
