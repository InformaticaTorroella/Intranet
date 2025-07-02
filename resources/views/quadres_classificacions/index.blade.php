@extends('layouts.app')

@section('content')
<h1>Quadres Classificacions</h1>

<a href="{{ route('quadres_classificacions.create') }}">Crear Nuevo</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Secció</th>
            <th>Subsecció</th>
            <th>Serie</th>
            <th>Tipologies GIAL</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($quadres_classificacions as $qc)
        <tr>
            <td>{{ $qc->id }}</td>
            <td>{{ $qc->seccio->nom ?? 'Ninguna' }}</td>
            <td>{{ $qc->subseccio->nom ?? 'Ninguna' }}</td>
            <td>{{ $qc->serie->nom ?? 'Ninguna' }}</td>
            <td>
                @foreach($qc->tipologies_gial as $tg)
                    {{ $tg->nom }}@if(!$loop->last), @endif
                @endforeach
            </td>
            <td>
                <a href="{{ route('quadres_classificacions.edit', $qc->id) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('seccions.index') }}">Gestionar Seccions</a>
<a href="{{ route('subseccions.index') }}">Gestionar Subseccions</a>
<a href="{{ route('series.index') }}">Gestionar Series</a>
@endsection
