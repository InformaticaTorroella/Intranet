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
      <section class="panel-enlaces">
        <div class="enlaces-grid">
          <a href="{{ route('noticias.index') }}" class="enlace-panel">Notícies</a>
          <a href="{{ route('documents.index') }}" class="enlace-panel">Documents</a>
          <a href="{{ route('avis.index') }}" class="enlace-panel">Avisos</a>
          <a href="{{ route('telefons.index') }}" class="enlace-panel">Telefons</a>
          <a href="#" class="enlace-panel">Circulars</a>
        </div>
      </section>

    </div>
    <main>

      <section class="noticias-container">
        <h1>Notícies Recents</h1>
        <div class="noticias-grid">
          @forelse ($noticias as $noticia)
            <a href="{{ route('noticias.show', $noticia->id) }}" class="noticia-link">
              <article class="noticia">
                <h2 class="noticia-titulo">{{ $noticia->nom }}</h2>
                <p class="noticia-data">Publicada: {{ \Carbon\Carbon::parse($noticia->data_publicacio)->format('d/m/Y') }}</p>
              </article>
            </a>
          @empty
            <p>No hi ha notícies disponibles.</p>
          @endforelse
        </div>
      </section>


    </main>

    <x-footer />
</body>
</html>
