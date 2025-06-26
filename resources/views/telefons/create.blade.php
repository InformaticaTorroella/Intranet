<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8">
  <title>Nou telèfon</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/telefons.css') }}">
</head>
<body>
<x-header />
  <h2>Nou Telèfon</h2>
  <form class="create-form" method="POST" action="{{ route('telefons.store') }}">
    @csrf

    <label class="form-label">Nom</label>
    <input type="text" name="nom_telefon" class="form-input" required>

    <label class="form-label">Directe</label>
    <input type="text" name="num_directe" class="form-input">

    <label class="form-label">Ext. VOIP</label>
    <input type="text" name="extensio_voip" class="form-input">

    <label class="form-label">Mòbil</label>
    <input type="text" name="num_directe_mobil" class="form-input">

    <label class="form-label">Ext. Mòbil</label>
    <input type="text" name="extensio_mobil" class="form-input">

    <label class="form-label">Àrea</label>
    <select name="area" class="form-select">
      <option value="">-- Selecciona Àrea --</option>
      @foreach ($arees as $area)
        <option value="{{ $area->IdArea }}">{{ $area->Area }}</option>
      @endforeach
    </select>

    <label class="form-label">Edifici</label>
    <select name="edifici" class="form-select">
      <option value="">-- Selecciona Edifici --</option>
      @foreach ($equipaments as $equipament)
        <option value="{{ $equipament->id_equimanent }}">{{ $equipament->Equipament }}</option>
      @endforeach
    </select>

    <label class="form-label">Tipus</label>
    <input type="number" name="fk_tipus_obj" class="form-input">

    <label class="form-label">Data Edició</label>
    <input type="date" name="data_edicio" class="form-input" value="{{ old('data_edicio', date('Y-m-d')) }}">

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('telefons.index') }}" class="btn btn-secondary">Cancel·la</a>
  </form>
<x-footer />
</body>
</html>