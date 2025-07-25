<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8">
  <title>Editar Registre AD #{{ $ad->id }}</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/op.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <style>
    /* Opcional: ajustar altura de desplegable */
    .select2-results__option small {
      display: block;
      color: gray;
      font-size: 0.8em;
    }
  </style>
</head>
<body>
  <x-header />

  <div class="container">
    <h1 class="page-title">Editar Registre AD #{{ $ad->id }}</h1>

    @if ($errors->any())
      <div class="error-box mb-4">
        <ul>
          @foreach ($errors->all() as $error)
            <li class="error">{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('op_ads.update', $ad->id) }}" method="POST" class="form-grid">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label for="data">Data:</label>
        <input type="date" name="data" value="{{ old('data', $ad->data) }}" required class="form-select">
        @error('data')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="responsable_id">Responsable:</label>
        <select name="responsable_id" class="form-select" required>
          <option value="">Selecciona responsable</option>
          @foreach($usuaris as $usuari)
            <option value="{{ $usuari->id }}" {{ old('responsable_id', $ad->responsable_id) == $usuari->id ? 'selected' : '' }}>
              {{ $usuari->nom }}
            </option>
          @endforeach
        </select>
        @error('responsable_id')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="partida">Partida:</label>
        <select name="partida" class="form-select" required>
          <option value="">Selecciona partida</option>
          @foreach($partides as $partida)
            <option value="{{ $partida->partida }}" {{ old('partida', $ad->partida) == $partida->partida ? 'selected' : '' }}>
              {{ $partida->descripcio }}
            </option>
          @endforeach
        </select>
        @error('partida')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="import_reserva">Import Reserva (€):</label>
        <input type="number" step="0.01" name="import_reserva" value="{{ old('import_reserva', $ad->import_reserva) }}" required class="form-select">
        @error('import_reserva')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="exp_sedipualba">Exp. Sedipualba:</label>
        <input type="text" name="exp_sedipualba" value="{{ old('exp_sedipualba', $ad->exp_sedipualba) }}" class="form-select">
        @error('exp_sedipualba')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="concepte_despesa">Concepte Despesa:</label>
        <input type="text" name="concepte_despesa" value="{{ old('concepte_despesa', $ad->concepte_despesa) }}" class="form-select">
        @error('concepte_despesa')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="cif">CIF (Proveïdor):</label>
        <select name="cif" class="form-select select2" style="width:100%;">
          <option value="">Selecciona proveïdor</option>
          @foreach($tercers as $tercer)
            <option value="{{ $tercer->TER_ITE }}" data-doc="{{ $tercer->TER_DOC }}"
              {{ old('cif', $ad->cif) == $tercer->TER_ITE ? 'selected' : '' }}>
              {{ $tercer->TER_NOM }}
            </option>
          @endforeach
        </select>
        @error('cif')<div class="error">{{ $message }}</div>@enderror
      </div>

      <div class="mb-4">
        <label for="rc">RC (reservat per intervenció):</label>
        <input type="text" name="rc" value="{{ old('rc', $ad->rc) }}" class="form-select">
        @error('rc')<div class="error">{{ $message }}</div>@enderror
      </div>

      <button type="submit" class="btn btn-primary">Actualitzar</button>
    </form>

    <a href="{{ route('op_ads.index') }}" class="btn btn-secondary">Tornar enrere</a>
  </div>
  <x-footer />

  <script>
    $(document).ready(function() {
      function formatTercer(tercer) {
        if (!tercer.id) {
          return tercer.text;
        }
        var terdoc = $(tercer.element).data('terdoc');
        if (terdoc) {
          return $('<span>' + tercer.text + '<br><small style="color:gray;">' + terdoc + '</small></span>');
        }
        return tercer.text;
      }

      function formatSelection(tercer) {
        if (!tercer.id) {
          return tercer.text;
        }
        var terdoc = $(tercer.element).data('terdoc');
        return terdoc || tercer.text;
      }

      $('.select2').select2({
        placeholder: 'Selecciona proveïdor',
        allowClear: true,
        minimumInputLength: 2,
        language: {
          inputTooShort: function() {
            return 'Escriu almenys 2 caràcters';
          },
          noResults: function() {
            return 'No s\'han trobat resultats';
          },
          searching: function() {
            return 'Cercant...';
          },
          loadingMore: function() {
            return 'Carregant més resultats...';
          }
        },
        templateResult: formatTercer,
        templateSelection: formatSelection,
      });
    });
  </script>

</body>
</html>
