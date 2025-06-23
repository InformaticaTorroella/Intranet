<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Avisos</title>
    <link rel="stylesheet" href="{{ asset('css/avis.css') }}">
</head>
<body>
    <x-header />
    <main>
        <div class="noticias-page-center">
            <section class="noticias-container">
                <h1>Avisos</h1>

                @forelse ($avisos as $avis)
                <article class="noticia {{ $avis->bool_avis_alert ? 'alerta' : 'avis' }}">
                    <h2 class="noticia-titulo">{{ $avis->titol }}</h2>
                    <p class="noticia-descripcio">{{ Str::limit($avis->contingut, 150) }}</p>
                    <p class="noticia-data">Creat: {{ \Carbon\Carbon::parse($avis->data_creacio)->format('d/m/Y H:i') }}</p>
                    <a href="{{ route('avis.show', $avis->id) }}" class="btn-ver">Veure</a>

                    @if(session()->has('username') && isset($avis->id))
                        <a href="{{ route('avis.edit', ['id' => $avis->id]) }}" class="btn-editar">Editar</a>
                    @endif
                </article>
            @empty
                <p>No hi ha avisos disponibles.</p>
            @endforelse


                @if(session()->has('username'))
                    <a href="{{ route('avis.create') }}" class="btn-crear">Crear Avis</a>
                @else
                    <p>Per crear un avís, si us plau, inicia sessió.</p>
                @endif
            </section>
        </div>
    </main>
    <x-footer />
</body>
</html>
