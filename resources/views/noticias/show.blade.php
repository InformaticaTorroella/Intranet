<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Detalle Notícia</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/noticias.css') }}">
</head>
<body>
  <x-header />

  <div class="main-content">
    <div class="detalle-container">
        <div><h1>{{ $noticia->nom }}</h1></div>

        <div class="detalle-item">
            <strong>Descripción:</strong>
            <div class="detalle-caja">{{ $noticia->descripcio }}</div>
        </div>

        <div class="detalle-item">
            <strong>Fecha publicación:</strong>
            <div class="detalle-caja">{{ \Carbon\Carbon::parse($noticia->data_publicacio)->format('d/m/Y') }}</div>
        </div>

        <div class="detalle-item">
            <strong>Publicado:</strong>
            <div class="detalle-caja">{{ $noticia->publicat ? 'Sí' : 'No' }}</div>
        </div>

        <div class="detalle-item">
            <strong>URL:</strong>
            <div class="detalle-caja">
            @if($noticia->url)
                <a href="{{ $noticia->url }}" target="_blank">{{ $noticia->url }}</a>
            @else
                <p>No disponible</p>
            @endif
            </div>
        </div>

        <div class="detalle-item">
            <strong>Data inicial:</strong>
            <div class="detalle-caja">{{ $noticia->data_inicial ?? '<p>No disponible</p>' }}</div>
        </div>

        <div class="detalle-item">
            <strong>Data final:</strong>
            <div class="detalle-caja">{{ $noticia->data_final ?? '<p>No disponible</p>' }}</div>
        </div>

        <div class="detalle-item">
            <strong>Tipus objecte (fk_tipus_obj):</strong>
            <div class="detalle-caja">{{ $noticia->fk_tipus_obj ?? '<p>No disponible</p>' }}</div>
        </div>
        
        <a href="{{ route('noticias.index') }}">Tornar</a>
        </div>


  </div>

  <x-footer />
</body>

</html>
