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
    <h1 class="text-2xl font-bold mb-4">Crear Quadre</h1>

    <form action="{{ route('quadres.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="fk_id_seccio">Secció</label>
            <select name="fk_id_seccio" class="form-select">
                @foreach($seccions as $seccio)
                    <option value="{{ $seccio->id_seccio }}">{{ $seccio->seccio }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="fk_id_subseccio">Subsecció</label>
            <select name="fk_id_subseccio" class="form-select">
                @foreach($subseccions as $subseccio)
                    <option value="{{ $subseccio->id_subseccio }}">{{ $subseccio->subseccio }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="fk_id_serie">Sèrie</label>
            <select name="fk_id_serie" class="form-select">
                @foreach($series as $serie)
                    <option value="{{ $serie->id_serie }}">{{ $serie->serie }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="tipologies[]">Tipologies GIAL</label>
            <select name="tipologies[]" multiple class="form-multiselect">
                @foreach($tipologies as $tipologia)
                    <option value="{{ $tipologia->id }}">{{ $tipologia->codi }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

</body>
</html>


