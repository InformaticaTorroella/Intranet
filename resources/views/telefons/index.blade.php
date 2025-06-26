<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Telèfons</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('css/telefons.css') }}" />
</head>
<body>
<x-header />
<main>
  <h2>Telèfons</h2>


  <form method="GET" action="{{ route('telefons.index') }}">
    <select id="equipament-select" name="id_equipament" onchange="this.form.submit()">
      <option value="">-- Selecciona Edifici --</option>
      @foreach ($equipaments as $equipament)
        <option value="{{ $equipament->id_equimanent }}" {{ request('id_equipament') == $equipament->id_equimanent ? 'selected' : '' }}>
          {{ $equipament->Equipament }}
        </option>
      @endforeach
    </select>

    <select id="area-select" name="area_id" onchange="this.form.submit()">
      <option value="">-- Selecciona Àrea --</option>
      @foreach ($arees as $area)
        <option value="{{ $area->IdArea }}" {{ request('area_id') == $area->IdArea ? 'selected' : '' }}>
          {{ $area->Area }}
        </option>
      @endforeach
    </select>
  </form>
  <a href="{{ route('telefons.create') }}" class="btn btn-primary">+ Nou telèfon</a>


    @if ($telefons->isEmpty())
      <p>No hi ha telèfons per a aquesta combinació d'equipament i àrea.</p>
    @else
      <table class="table">
        @php
    $currentOrderBy = request('order_by');
    $currentOrder = request('order', 'asc');
    function sortIcon($col, $currentOrderBy, $currentOrder) {
        if ($currentOrderBy === $col) {
            return $currentOrder === 'asc' ? 'fa-sort-up' : 'fa-sort-down';
        }
        return 'fa-sort';
    }
  @endphp

  <thead>
    <tr>
      <th>
        <span onclick="location.href='{{ route('telefons.index', array_merge(request()->all(), ['order_by' => 'nom', 'order' => ($currentOrderBy == 'nom' && $currentOrder == 'asc') ? 'desc' : 'asc'])) }}'" style="cursor:pointer;">
          Persona / Càrrec
          <i class="fas {{ sortIcon('nom', $currentOrderBy, $currentOrder) }}"></i>
        </span>
      </th>
      <th>
        <span onclick="location.href='{{ route('telefons.index', array_merge(request()->all(), ['order_by' => 'num_directe', 'order' => ($currentOrderBy == 'num_directe' && $currentOrder == 'asc') ? 'desc' : 'asc'])) }}'" style="cursor:pointer;">
          Número Tel
          <i class="fas {{ sortIcon('num_directe', $currentOrderBy, $currentOrder) }}"></i>
        </span>
      </th>
      <th>
        <span onclick="location.href='{{ route('telefons.index', array_merge(request()->all(), ['order_by' => 'extensio_voip', 'order' => ($currentOrderBy == 'extensio_voip' && $currentOrder == 'asc') ? 'desc' : 'asc'])) }}'" style="cursor:pointer;">
          Extensió VOIP
          <i class="fas {{ sortIcon('extensio_voip', $currentOrderBy, $currentOrder) }}"></i>
        </span>
      </th>
      <th>
        <span onclick="location.href='{{ route('telefons.index', array_merge(request()->all(), ['order_by' => 'num_directe_mobil', 'order' => ($currentOrderBy == 'num_directe_mobil' && $currentOrder == 'asc') ? 'desc' : 'asc'])) }}'" style="cursor:pointer;">
          Telèfon Mòbil
          <i class="fas {{ sortIcon('num_directe_mobil', $currentOrderBy, $currentOrder) }}"></i>
        </span>
      </th>
      <th>
        <span onclick="location.href='{{ route('telefons.index', array_merge(request()->all(), ['order_by' => 'extensio_mobil', 'order' => ($currentOrderBy == 'extensio_mobil' && $currentOrder == 'asc') ? 'desc' : 'asc'])) }}'" style="cursor:pointer;">
          Extensió Mòbil
          <i class="fas {{ sortIcon('extensio_mobil', $currentOrderBy, $currentOrder) }}"></i>
        </span>
      </th>
      <th>
        <span onclick="location.href='{{ route('telefons.index', array_merge(request()->all(), ['order_by' => 'fk_id_area', 'order' => ($currentOrderBy == 'fk_id_area' && $currentOrder == 'asc') ? 'desc' : 'asc'])) }}'" style="cursor:pointer;">
          Àrea
          <i class="fas {{ sortIcon('fk_id_area', $currentOrderBy, $currentOrder) }}"></i>
        </span>
      </th>
      <th>
        <span onclick="location.href='{{ route('telefons.index', array_merge(request()->all(), ['order_by' => 'fk_id_equipament', 'order' => ($currentOrderBy == 'fk_id_equipament' && $currentOrder == 'asc') ? 'desc' : 'asc'])) }}'" style="cursor:pointer;">
          Edifici
          <i class="fas {{ sortIcon('fk_id_equipament', $currentOrderBy, $currentOrder) }}"></i>
        </span>
      </th>
      <th>Accions</th>
    </tr>
  </thead>

      <tbody>
        @foreach ($telefons as $telefon)
          <tr>
            <td>{{ $telefon->nom }}</td>
            <td>{{ $telefon->num_directe ?? 'No disponible' }}</td>
            <td>{{ $telefon->extensio_voip ?? 'No disponible' }}</td>
            <td>{{ $telefon->num_directe_mobil ?? 'No disponible' }}</td>
            <td>{{ $telefon->extensio_mobil ?? 'No disponible' }}</td>
            <td>{{ $telefon->area->Area ?? 'No disponible' }}</td>
            <td>{{ $telefon->equipament->Equipament ?? 'No disponible' }}</td>
            <td class="actions">
              @if(session()->has('username'))
                <a href="{{ route('telefons.edit', $telefon->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('telefons.destroy', $telefon->id) }}" method="POST" onsubmit="return confirm('Segur?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
              @else
                <p>
                  Per editar o eliminar un telèfon, si us plau,
                  <a href="{{ route('login') }}">inicia sessió</a>.
                </p>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>

    </table>
  @endif
</main>

<x-footer />
</body>
</html>
