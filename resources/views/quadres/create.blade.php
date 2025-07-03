<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Crear Quadre de Classificacions</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <select name="fk_id_seccio" id="fk_id_seccio" class="form-select">
                <option value="">-- Selecciona Secció --</option>
                @foreach($seccions as $seccio)
                    <option value="{{ $seccio->id_seccio }}" {{ old('fk_id_seccio') == $seccio->id_seccio ? 'selected' : '' }}>
                        {{ $seccio->seccio }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="fk_id_subseccio">Subsecció</label>
            <select name="fk_id_subseccio" id="fk_id_subseccio" class="form-select" required>
                <option value="">-- Selecciona Subsecció --</option>
                @foreach($subseccions as $subseccio)
                    <option value="{{ $subseccio->id_subseccio }}" {{ old('fk_id_subseccio') == $subseccio->id_subseccio ? 'selected' : '' }}>
                        {{ $subseccio->subseccio }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="fk_id_serie">Sèrie</label>
            <select name="fk_id_serie" id="fk_id_serie" class="form-select" required>
                <option value="">-- Selecciona Sèrie --</option>
                @foreach($series as $serie)
                    <option value="{{ $serie->id_serie }}" {{ old('fk_id_serie') == $serie->id_serie ? 'selected' : '' }}>
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
                        @if(!in_array($tipologia->id, old('tipologies', [])))
                            <option value="{{ $tipologia->id }}">{{ $tipologia->codi }}</option>
                        @endif
                    @endforeach
                </select>

                <div class="dual-listbox-buttons">
                    <button type="button" onclick="moveSelected('available-tipologies', 'selected-tipologies')" title="Afegir">&raquo;</button>
                    <button type="button" onclick="moveSelected('selected-tipologies', 'available-tipologies')" title="Treure">&laquo;</button>
                </div>

                <select id="selected-tipologies" name="tipologies[]" multiple size="8" class="form-multiselect">
                    @foreach($tipologies as $tipologia)
                        @if(in_array($tipologia->id, old('tipologies', [])))
                            <option value="{{ $tipologia->id }}" selected>{{ $tipologia->codi }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('quadres.index') }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>
    </form>
</div>
<x-footer />
<script>
$(document).ready(function() {
  $('#fk_id_seccio').change(function() {
    const seccioId = $(this).val();

    // Limpiar subseccio y serie
    $('#fk_id_subseccio').html('<option value="">-- Selecciona Subsecció --</option>');
    $('#fk_id_serie').html('<option value="">-- Selecciona Sèrie --</option>');

    if (!seccioId) return;

    // Cargar subseccions
    $.get('/api/subseccions/' + seccioId, function(data) {
      data.forEach(subseccio => {
        $('#fk_id_subseccio').append(`<option value="${subseccio.id_subseccio}">${subseccio.subseccio}</option>`);
      });
    });
  });

  $('#fk_id_subseccio').change(function() {
    const subseccioId = $(this).val();

    // Limpiar serie
    $('#fk_id_serie').html('<option value="">-- Selecciona Sèrie --</option>');

    if (!subseccioId) return;

    // Cargar series
    $.get('/api/series/' + subseccioId, function(data) {
      data.forEach(serie => {
        $('#fk_id_serie').append(`<option value="${serie.id_serie}">${serie.serie}</option>`);
      });
    });
  });
});
</script>

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

</body>
</html>
