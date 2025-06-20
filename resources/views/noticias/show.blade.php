<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalle Notícia</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/noticias.css') }}">
</head>
<body>
    <div class="detalle-container">
        <h1>{{ $noticia->nom }}</h1>

        <p><strong>Descripción:</strong> {{ $noticia->descripcio }}</p>
        <p><strong>Fecha publicación:</strong> {{ \Carbon\Carbon::parse($noticia->data_publicacio)->format('d/m/Y') }}</p>
        <p><strong>Publicado:</strong> {{ $noticia->publicat ? 'Sí' : 'No' }}</p>
        <p><strong>URL:</strong> 
            @if($noticia->url)
                <a href="{{ $noticia->url }}" target="_blank">{{ $noticia->url }}</a>
            @else
                No disponible
            @endif
        </p>
        <p><strong>Data inicial:</strong> {{ $noticia->data_inicial ?? 'No disponible' }}</p>
        <p><strong>Data final:</strong> {{ $noticia->data_final ?? 'No disponible' }}</p>
        <p><strong>Tipus objecte (fk_tipus_obj):</strong> {{ $noticia->fk_tipus_obj ?? 'No disponible' }}</p>

        <a href="{{ route('noticias.index') }}">Volver a lista</a>
    </div>
</body>
</html>
