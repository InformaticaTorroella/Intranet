<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Circulars</title>
    <link rel="stylesheet" href="{{ asset('css/circulars.css') }}">
</head>
<body>
    <x-header />
    @php
      $userGroups = session('user_groups', []);
    @endphp
    <div class="circulars-page-center">
        <div class="circulars-container">
            <h1>Circulars</h1>

            @forelse ($circulars as $circular)
                <article class="circular">
                    <h2 class="circular-nom_visual">{{ $circular->nom_visual }}</h2>
                    <p>Fitxer: {{ $circular->nom_arxiu }}</p>
                    <p>Data Creació: {{ $circular->data_creacio ? \Carbon\Carbon::parse($circular->data_creacio)->format('d/m/Y H:i') : '' }}</p>
                    <p>Extensió: {{ $circular->extensio }}</p>
                    <p>Ordre: {{ $circular->ordre }}</p>
                    <p>Categoria ID: {{ $circular->fk_cat_circular }}</p>
                    <p>Tipus Objecte: {{ $circular->fk_tipus_obj }}</p>

                    <a href="{{ route('circulars.view', ['id' => $circular->id, 'action' => 'view']) }}" target="_blank" class="btn-veure">Veure</a>
                    <a href="{{ route('circulars.view', ['id' => $circular->id, 'action' => 'download']) }}" class="btn-veure">Descarregar</a>

                    @if(session()->has('username') && in_array('Intranet_Circulars', $userGroups)
                        <a href="{{ route('circulars.edit', $circular->id) }}" class="btn-editar">Editar</a>

                        <form action="{{ route('circulars.destroy', $circular->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-editar btn-elim" onclick="return confirm('Segur que vols eliminar aquesta circular?')">Eliminar</button>
                        </form>
                    @endif
                </article>
            @empty
                <p>No hi ha circulars disponibles.</p>
            @endforelse

            @if(session()->has('username') && in_array('Intranet_Circulars', $userGroups))
                <a href="{{ route('circulars.create') }}" class="btn-crear">Crear Circular</a>
            @else
                <p>No teniu permisos per a crear circulars.</p>
            @endif
        </div>
    </div>

    <x-footer />
</body>
</html>
