<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Quadre de Classificacions</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}" />
  <style>
    .dual-listbox {
      display: flex;
      gap: 1rem;
      align-items: center;
    }
    select.form-multiselect {
      width: 200px;
      height: 180px;
    }
    .dual-listbox-buttons {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .dual-listbox-buttons button {
      width: 40px;
      height: 40px;
      font-size: 1.2rem;
      cursor: pointer;
    }
  </style>
</head>
<body>
<x-header />
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Editar Quadre</h1>

    <form action="{{ route('quadres.update', $quadre) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="fk_id_seccio">Secció</label>
            <select name="fk_id_seccio" id="fk_id_seccio" class="form-select" required>
                @foreach($seccions as $seccio)
                    <option value="{{ $seccio->id_seccio }}" {{ $quadre->fk_id_seccio == $seccio->id_seccio ? 'selected' : '' }}>
                        {{ $seccio->seccio }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="fk_id_subseccio">Subsecció</label>
            <select name="fk_id_subseccio" id="fk_id_subseccio" class="form-select" required>
                @foreach($subseccions as $subseccio)
                    <option value="{{ $subseccio->id_subseccio }}" {{ $quadre->fk_id_subseccio == $subseccio->id_subseccio ? 'selected' : '' }}>
                        {{ $subseccio->subseccio }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="fk_id_serie">Sèrie</label>
            <select name="fk_id_serie" id="fk_id_serie" class="form-select" required>
                @foreach($series as $serie)
                    <option value="{{ $serie->id_serie }}" {{ $quadre->fk_id_serie == $serie->id_serie ? 'selected' : '' }}>
                        {{ $serie->serie }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Tipologies GIAL</label>
            <div class="dual-listbox">
                <select id="available-tipologies" multiple size="8" class="form-multiselect">
                    @foreach($tipologies as $tipologia)
                        @if(!$quadre->tipologies->contains($tipologia->id))
                            <option value="{{ $tipologia->id }}">{{ $tipologia->codi }}</option>
                        @endif
                    @endforeach
                </select>

                <div class="dual-listbox-buttons">
                    <button type="button" onclick="moveSelected('available-tipologies', 'selected-tipologies')" title="Afegir">&raquo;</button>
                    <button type="button" onclick="moveSelected('selected-tipologies', 'available-tipologies')" title="Treure">&laquo;</button>
                </div>

                <select id="selected-tipologies" name="tipologies[]" multiple size="8" class="form-multiselect">
                    @foreach($quadre->tipologies as $tipologia)
                        <option value="{{ $tipologia->id }}" selected>{{ $tipologia->codi }}</option>
                    @endforeach
                </select>
            </div>
        </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('quadres.index') }}" class="btn btn-secondary">Tornar</a>
        </form>

        <form action="{{ route('quadres.destroy', $quadre->id) }}" method="POST" class="inline-form" style="display:inline-block" onsubmit="return confirm('Segur que vols eliminar aquest quadre?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
</div>

<script>
function moveSelected(fromId, toId) {
  const from = document.getElementById(fromId);
  const to = document.getElementById(toId);
  Array.from(from.selectedOptions).forEach(option => {
    to.appendChild(option);
  });
}
// Antes de enviar el formulario seleccionamos todas las opciones para que se envíen correctamente
document.querySelector('form').addEventListener('submit', function () {
  const selected = document.getElementById('selected-tipologies');
  for (let i = 0; i < selected.options.length; i++) {
    selected.options[i].selected = true;
  }
});
</script>
<x-footer />
</body>
</html>
