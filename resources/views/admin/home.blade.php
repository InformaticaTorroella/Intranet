<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <title>Intranet de Torroella de Montgrí</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <x-header />

    
    <div class="espacio-superior">
      <a href="{{ route('noticias.index') }}">Gestionar Noticias</a>
    </div>
    <main>

      <section class="noticias-container">
        <h1>Noticies Recents</h1>
          @forelse ($noticias as $noticia)
              <article class="noticia">
                  <h2 class="noticia-titulo">{{ $noticia->nom }}</h2>
                  <p class="noticia-descripcio">{{ $noticia->descripcio }}</p>
                  <p class="noticia-data">Publicada: {{ \Carbon\Carbon::parse($noticia->data_publicacio)->format('d/m/Y') }}</p>
              </article>
          @empty
              <p>No hi ha notícies disponibles.</p>
          @endforelse
        </section> 
    </main>

    <x-footer />
</body>
</html>
