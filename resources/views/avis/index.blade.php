<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Avisos</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/avis.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
</head>
<body>
    <x-header />
    @php
      $userGroups = session('user_groups', []);
    @endphp
    <main>
        <div class="noticias-page-center">
            <section class="noticias-container">
                <h1>Avisos</h1>
                <form method="GET" action="{{ route('avis.index') }}" class="avis-filter-form">
                    <label for="filter_tipo">Tipus d'avís:</label>
                    <select name="filter_tipo" id="filter_tipo">
                        <option value="" {{ request('filter_tipo') == '' ? 'selected' : '' }}>Tots</option>
                        <option value="info" {{ request('filter_tipo') == 'info' ? 'selected' : '' }}>Informació</option>
                        <option value="alert" {{ request('filter_tipo') == 'alert' ? 'selected' : '' }}>Alerta</option>
                    </select>

                    <label for="filter_solucionat">Estat:</label>
                    <select name="filter_solucionat" id="filter_solucionat">
                        <option value="" {{ request('filter_solucionat') == '' ? 'selected' : '' }}>Tots</option>
                        <option value="1" {{ request('filter_solucionat') == '1' ? 'selected' : '' }}>Solucionat</option>
                        <option value="0" {{ request('filter_solucionat') == '0' ? 'selected' : '' }}>No solucionat</option>
                    </select>

                    <button class="filter-button" type="submit">Filtrar</button>
                </form>

                @forelse ($avisos as $avis)
                <article class="noticia {{ $avis->bool_avis_alert ? 'alerta' : 'avis' }}">
                    <h2 class="noticia-titulo">{{ $avis->titol }}</h2>
                    <p class="noticia-descripcio">{{ Str::limit($avis->contingut, 150) }}</p>
                    <span class="avis-estat {{ $avis->solucionat ? 'solucionat' : 'no-solucionat' }}">
                        {{ $avis->solucionat ? 'Solucionat' : 'No solucionat' }}
                    </span>

                    <p class="noticia-data">Creat: {{ \Carbon\Carbon::parse($avis->data_creacio)->format('d/m/Y H:i') }}</p>
                    <a href="{{ route('avis.show', $avis->id) }}" class="btn-ver">Veure</a>

                    @if(session()->has('username') && in_array('Intranet_Avisos', $userGroups) &&isset($avis->id))
                        <a href="{{ route('avis.edit', ['id' => $avis->id]) }}" class="btn-editar">Editar</a>
                    @endif
                </article>
            @empty
                <p>No hi ha avisos disponibles.</p>
            @endforelse


                @if(session()->has('username') && in_array('Intranet_Avisos', $userGroups))
                    <a href="{{ route('avis.create') }}" class="btn-crear">Crear Avis</a>
                @else
                    <p>
                        Per crear un avís, si us plau,
                        <a href="{{ route('login') }}">inicia sessió</a>.
                    </p>
                @endif
                <div class="pagination">
                    {{ $avisos->links() }}
                </div>
            </section>
            
        </div>
    </main>
    <x-footer />
</body>
</html>
