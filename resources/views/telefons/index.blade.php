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
  @php
      $userGroups = session('user_groups', []);
  @endphp
  <h2>Telèfons</h2>

  <form id="filter-form" method="GET" action="{{ route('telefons.index') }}">
    <select id="equipament-select" name="id_equipament" onchange="submitForm()">
      <option value="">-- Selecciona Edifici --</option>
      @foreach ($equipaments as $equipament)
        <option value="{{ $equipament->id_equimanent }}" {{ request('id_equipament') == $equipament->id_equimanent ? 'selected' : '' }}>
          {{ $equipament->Equipament }}
        </option>
      @endforeach
    </select>

    <select id="area-select" name="area_id" onchange="submitForm()">
      <option value="">-- Selecciona Àrea --</option>
      @foreach ($arees as $area)
        <option value="{{ $area->IdArea }}" {{ request('area_id') == $area->IdArea ? 'selected' : '' }}>
          {{ $area->Area }}
        </option>
      @endforeach
    </select>

    @if(session()->has('username') && in_array('Intranet_Telefons', $userGroups))
      <div>
        <a href="{{ route('area-telefons.create') }}" class="btn btn-secondary">+ Afegir Àrea</a>
        <a href="{{ route('edifici-telefons.create') }}" class="btn btn-secondary">+ Afegir Edifici</a>
      </div>
    @endif

    <input
      type="text"
      name="nom"
      id="nom"
      placeholder="Cerca per nom..."
      value="{{ request('nom') }}"
      autocomplete="off"
    />
  </form>

  <a href="{{ route('telefons.create') }}" class="btn btn-primary">+ Nou telèfon</a>

  @if ($telefons->isEmpty())
    <p>No hi ha telèfons per a aquesta combinació d'equipament i àrea.</p>
  @else
    <table class="table" id="telefonsTable">
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
          @if(session()->has('username') && in_array('Intranet_Telefons', session('user_groups', [])))
          <th>Accions</th>
          @endif
        </tr>
      </thead>

      <tbody>
        @forelse ($telefons as $telefon)
          <tr>
            <td>{{ $telefon->nom }}</td>
            <td>{{ $telefon->num_directe ?? 'No disponible' }}</td>
            <td>{{ $telefon->extensio_voip ?? 'No disponible' }}</td>
            <td>{{ $telefon->num_directe_mobil ?? 'No disponible' }}</td>
            <td>{{ $telefon->extensio_mobil ?? 'No disponible' }}</td>
            <td>{{ $telefon->area->Area ?? 'No disponible' }}</td>
            <td>{{ $telefon->equipament->Equipament ?? 'No disponible' }}</td>
            @if(session()->has('username') && in_array('Intranet_Telefons', session('user_groups', [])))
              <td class="actions">
                <div class="action-wrapper">
                  <a href="{{ route('telefons.edit', $telefon->id) }}" class="btn btn-warning">Editar</a>
                  <form action="{{ route('telefons.destroy', $telefon->id) }}" method="POST" onsubmit="return confirm('Segur?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                </div>
              </td>
            @endif
          </tr>
        @empty
          <tr>
            <td colspan="8">No s'han trobat telèfons per aquesta cerca.</td>
          </tr>
        @endforelse
      </tbody>

    </table>

    <div class="pagination">
      {{ $telefons->links() }}
    </div>
  @endif
</main>

<x-footer />

<script>
  function submitForm() {
    document.getElementById('filter-form').submit();
  }

  const filterForm = document.getElementById('filter-form');
  const telefonsTable = document.getElementById('telefonsTable');

  let timeout = null;

  nomInput.addEventListener('input', function() {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
      const formData = new FormData(filterForm);
      formData.set('nom', nomInput.value);
      const params = new URLSearchParams(formData).toString();

      fetch(`{{ route('telefons.index') }}?${params}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(response => response.text())
      .then(html => {
      });
    }, 300);
  });
</script>

</body>
</html>
