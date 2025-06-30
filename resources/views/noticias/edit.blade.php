<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar Notícia</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/noticias.css') }}">
</head>
<body>
    <x-header />
    
    <h1>Editar Notícia</h1>
    <form action="{{ route('noticias.update', $noticia->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nom:</label>
        <input type="text" name="nom_noticia" value="{{ old('nom_noticia', $noticia->nom) }}" required>

        <label>Descripció:</label>
        <textarea name="descripcio_noticia" required>{{ old('descripcio_noticia', $noticia->descripcio) }}</textarea>

        <label>Data de publicació:</label>
        <input type="datetime-local" name="data_pub" 
            value="{{ old('data_pub', \Carbon\Carbon::parse($noticia->data_publicacio)->format('Y-m-d\TH:i')) }}" required>

        <label>Publicat:</label>
        <select name="bool_pub" required>
            <option value="1" {{ old('bool_pub', $noticia->publicat) == 1 ? 'selected' : '' }}>Sí</option>
            <option value="0" {{ old('bool_pub', $noticia->publicat) == 0 ? 'selected' : '' }}>No</option>
        </select>

        <label>URL document:</label>
        <input type="text" name="url_document" value="{{ old('url_document', $noticia->url) }}">

        <label>Data inicial:</label>
        <input type="date" name="data_inicial" value="{{ old('data_inicial', $noticia->data_inicial) }}" required>

        <label>Data final:</label>
        <input type="date" name="data_final" value="{{ old('data_final', $noticia->data_final) }}" required>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button class="btn-go-back" type="button" onclick="window.location.href='{{ route('noticias.index') }}'">Tornar</button>
    </form>
    
    <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Segur que bols eliminar aquesta notícia?')">Eliminar</button>
    </form>

    <x-footer />
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            if (!confirm('¿Estás seguro de que quieres guardar los cambios?')) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
