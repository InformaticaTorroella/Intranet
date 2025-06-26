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
    <div class="noticias-page-center">
        <section class="noticias-container">
            <h1>Notícies</h1>

            @forelse ($noticias as $noticia)
                <article class="noticia">
                    <h2 class="noticia-titulo">{{ $noticia->nom }}</h2>
                    <p class="noticia-descripcio">{{ $noticia->descripcio }}</p>
                    <p class="noticia-data">Publicada: {{ \Carbon\Carbon::parse($noticia->data_publicacio)->format('d/m/Y') }}</p>
                    <a href="{{ route('noticias.show', $noticia->id) }}" class="btn-ver">Veure</a>

                    @if(session()->has('username') && isset($noticia->id))
                        <a href="{{ route('noticias.edit', ['id' => $noticia->id]) }}" class="btn-editar">Editar</a>
                    @endif
                </article>
            @empty
                <p>No hi ha notícies disponibles.</p>
            @endforelse

            @if(session()->has('username'))
                <a href="{{ route('noticias.create') }}" class="btn-crear">Crear Notícia</a>
            @else
                <p>
                  Per crear un notícia, si us plau,
                  <a href="{{ route('login') }}">inicia sessió</a>.
                </p>
            @endif
        </section>
    </div>
    <x-footer />

</body>
</html>
