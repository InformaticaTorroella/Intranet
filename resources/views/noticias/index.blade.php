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
    @php
      $userGroups = session('user_groups', []);
    @endphp
    <div class="noticias-page-center">
        <section class="noticias-container">
            <h1>Notícies</h1>
            <form method="GET" action="{{ route('noticias.index') }}" class="noticias-filter-form">
                <label for="filter_categoria">Categoria:</label>
                <select name="filter_categoria" id="filter_categoria" onchange="this.form.submit()">
                    <option value="" {{ request('filter_categoria') == '' ? 'selected' : '' }}>Totes</option>
                    @foreach($categories as $categoria)
                        <option value="{{ $categoria->id }}" {{ request('filter_categoria') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nom }}
                        </option>
                    @endforeach
                </select>
                @if(session()->has('username') && in_array('Intranet_Telefons', $userGroups))
                    <a href="{{ route('categoria-noticias.create') }}" class="btn-secondary">Afegir Categoria</a>
                @endif
            </form>

            @forelse ($noticias as $noticia)
                <article class="noticia">
                    <h2 class="noticia-titulo">{{ $noticia->nom }}</h2>
                    <p class="noticia-descripcio">{{ $noticia->descripcio }}</p>
                    <p class="noticia-data">Publicada: {{ \Carbon\Carbon::parse($noticia->data_publicacio)->format('d/m/Y') }}</p>
                    <a href="{{ route('noticias.show', $noticia->id) }}" class="btn-ver">Veure</a>

                    @if(session()->has('username') && in_array('Intranet_Noticies', $userGroups) && isset($noticia->id))
                        <a href="{{ route('noticias.edit', ['id' => $noticia->id]) }}" class="btn-editar">Editar</a>
                    @endif
                </article>
            @empty
                <p>No hi ha notícies disponibles.</p>
            @endforelse

            @if(session()->has('username') && in_array('Intranet_Telefons', $userGroups))
                <a href="{{ route('noticias.create') }}" class="btn-crear">Crear Notícia</a>
            @else
                <p>
                  No tens permisos per crear notícies. <br>
                  Si vols crear notícies, contacta amb el seu administrador.
                </p>
            @endif
        </section>
    </div>
    <x-footer />

</body>
</html>
