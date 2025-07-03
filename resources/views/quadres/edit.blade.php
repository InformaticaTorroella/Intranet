<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Quadre de Classificacions</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}" />
</head>
<body>
<x-header />
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Editar Quadre</h1>

    <form action="{{ route('quadres.update', $quadre) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="fk_id_seccio">Secció</label>
            <select name="fk_id_seccio" class="form-select">
                @foreach($seccions as $seccio)
                    <option value="{{ $seccio->id_seccio }}" {{ $quadre->fk_id_seccio == $seccio->id_seccio ? 'selected' : '' }}>{{ $seccio->seccio }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="fk_id_subseccio">Subsecció</label>
            <select name="fk_id_subseccio" class="form-select">
                @foreach($subseccions as $subseccio)
                    <option value="{{ $subseccio->id_subseccio }}" {{ $quadre->fk_id_subseccio == $subseccio->id_subseccio ? 'selected' : '' }}>{{ $subseccio->subseccio }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="fk_id_serie">Sèrie</label>
            <select name="fk_id_serie" class="form-select">
                @foreach($series as $serie)
                    <option value="{{ $serie->id_serie }}" {{ $quadre->fk_id_serie == $serie->id_serie ? 'selected' : '' }}>{{ $serie->serie }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="tipologies[]">Tipologies GIAL</label>
            <select name="tipologies[]" multiple class="form-multiselect">
                @foreach($tipologies as $tipologia)
                    <option value="{{ $tipologia->id }}" {{ $quadre->tipologies->contains($tipologia->id) ? 'selected' : '' }}>{{ $tipologia->codi }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualitzar</button>
    </form>
</div>

</body>
</html>
