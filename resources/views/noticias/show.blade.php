<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Noticias</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/noticias.css') }}">
</head>
<body>
  <x-header />

  <div class="main-content">
    <div class="detalle-container">
        <div><h1>{{ $noticia->nom }}</h1></div>

        <div class="detalle-item">
            <strong>Descriptció:</strong>
            <div class="detalle-caja">{{ $noticia->descripcio }}</div>
        </div>

        <div class="detalle-item">
            <strong>Data de publicació:</strong>
            <div class="detalle-caja">{{ \Carbon\Carbon::parse($noticia->data_publicacio)->format('d/m/Y') }}</div>
        </div>

        <div class="detalle-item">
            <strong>Publicat:</strong>
            <div class="detalle-caja">{{ $noticia->publicat ? 'Sí' : 'No' }}</div>
        </div>

        <div class="detalle-item">
            <strong>URL:</strong>
            <div class="detalle-caja"><a class="url" href="{{ $noticia->url ?? '' }}">{{ $noticia->url ?? 'No disponible' }}</a></div>
        </div>

        <div class="detalle-item">
            <strong>Data inicial:</strong>
            <div class="detalle-caja">{{ $noticia->data_inicial ?? 'No disponible' }}</div>
        </div>

        <div class="detalle-item">
            <strong>Data final:</strong>
            <div class="detalle-caja">{{ $noticia->data_final ?? 'No disponible' }}</div>
        </div>

        <div class="detalle-item">
            <strong>Tipus objecte (fk_tipus_obj):</strong>
            <div class="detalle-caja">{{ $noticia->fk_tipus_obj ?? 'No disponible' }}</div>
        </div>
        
        <a class="goBack" href="{{ route('noticias.index') }}">Tornar</a>
        </div>


  </div>

  <x-footer />
</body>

</html>
