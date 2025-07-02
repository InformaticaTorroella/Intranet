@extends('layouts.app')

@section('content')
<h1>Editar Quadre Classificació</h1>

<form action="{{ route('quadres_classificacions.update', $quadre_classificacio->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <label for="id_seccio">Secció:</label>
    <select name="fk_id_seccio" id="id_seccio" required>
        <option value="">Selecciona una secció</option>
        @foreach($seccions as $seccio)
            <option value="{{ $seccio->id_seccio }}" {{ $quadre_classificacio->fk_id_seccio == $seccio->id_seccio ? 'selected' : '' }}>
                {{ $seccio->nom }}
            </option>
        @endforeach
    </select>

    <label for="id_subseccio">Subsecció:</label>
    <select name="fk_id_subseccio" id="id_subseccio" required>
        <option value="">Selecciona una subsecció</option>
        @foreach($subseccions as $subseccio)
            <option value="{{ $subseccio->id_subseccio }}" {{ $quadre_classificacio->fk_id_subseccio == $subseccio->id_subseccio ? 'selected' : '' }}>
                {{ $subseccio->nom }}
            </option>
        @endforeach
    </select>

    <label for="id_serie">Serie:</label>
    <select name="fk_id_serie" id="id_serie" required>
        <option value="">Selecciona una serie</option>
        @foreach($series as $serie)
            <option value="{{ $serie->id_serie }}" {{ $quadre_classificacio->fk_id_serie == $serie->id_serie ? 'selected' : '' }}>
                {{ $serie->nom }}
            </option>
        @endforeach
    </select>

    <label for="tipologies_gial">Tipologies GIAL (Ctrl+click para seleccionar múltiples):</label>
    <select name="tipologies_gial[]" id="tipologies_gial" multiple>
        @foreach($tipologies_gial as $tg)
            <option value="{{ $tg->id }}" {{ in_array($tg->id, $quadre_classificacio->tipologies_gial->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $tg->nom }}
            </option>
        @endforeach
    </select>

    <!-- Añade aquí otros campos que tengas en quadres_classificacions -->

    <button type="submit">Guardar</button>
</form>

<a href="{{ route('quadres_classificacions.index') }}">Volver</a>
@endsection
