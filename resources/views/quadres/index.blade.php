<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8" />
  <title>Quadre de Classificacions</title>
  <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/quadres.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/pagination.css') }}" />
</head>
<body>
<x-header />
<main>
  @php
      $userGroups = session('user_groups', []);
      $hasAccess = session()->has('username') && (in_array('Intranet_Arxiver', $userGroups) || in_array('Intranet_Administracio', $userGroups));

      function sortIcon($col, $currentOrderBy, $currentOrder) {
          if ($currentOrderBy === $col) {
              return $currentOrder === 'asc' ? 'fa-sort-up' : 'fa-sort-down';
          }
          return 'fa-sort';
      }
  @endphp

<div class="container">
  <h1 class="page-title">Quadres</h1>
  @if($hasAccess)
    <a href="{{ route('quadres.create') }}" class="btn btn-primary mb-4">Crear Nou Quadre</a>
    <a href="{{ route('seccions.create') }}" class="btn btn-primary mb-4">Crear Nova Secció</a>
    <a href="{{ route('subseccions.create') }}" class="btn btn-primary mb-4">Crear Nova Subsecció</a>
    <a href="{{ route('series.create') }}" class="btn btn-primary mb-4">Crear Nova Sèrie</a>
    <a href="{{ route('tipologies-gial.create') }}" class="btn btn-primary mb-4">Crear Nova Tipologia GIAL</a>
  @endif

  <form id="filter-form" method="GET" action="{{ route('quadres.index') }}">
    <input 
      type="text" 
      name="serie" 
      placeholder="Filtrar per Sèrie" 
      value="{{ request('serie') }}" 
      class="search-input" 
      onkeydown="if(event.key === 'Enter') this.form.submit()"
    >

    <input 
      type="text" 
      name="tipologia_gial" 
      placeholder="Filtrar per Tipologia GIAL" 
      value="{{ request('tipologia_gial') }}" 
      class="search-input" 
      onkeydown="if(event.key === 'Enter') this.form.submit()"
    >

    <input type="hidden" name="order_by" value="{{ request('order_by', '') }}">
    <input type="hidden" name="order" value="{{ request('order', '') }}">
  </form>


  <table class="table">
    <thead>
      <tr>
        <th class="table-header sortable" onclick="sortTable('fk_id_seccio')">
          Secció 
          <i class="fas {{ sortIcon('fk_id_seccio', request('order_by'), request('order')) }}"></i>
        </th>
        <th class="table-header sortable" onclick="sortTable('fk_id_subseccio')">
          Subsecció
          <i class="fas {{ sortIcon('fk_id_subseccio', request('order_by'), request('order')) }}"></i>
        </th>
        <th class="table-header sortable" onclick="sortTable('fk_id_serie')">
          Sèrie 
          <i class="fas {{ sortIcon('fk_id_serie', request('order_by'), request('order')) }}"></i>
        </th>
        <th class="table-header sortable" onclick="sortTable('fk_id_tipologia_gial')">
          Tipologies GIAL
          <i class="fas {{ sortIcon('fk_id_tipologia_gial', request('order_by'), request('order')) }}"></i>
        </th>
        @if($hasAccess)
          <th class="table-header">Accions</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach($quadres as $quadre)
      <tr class="table-row">
        <td class="table-cell">{{ $quadre->seccio->seccio ?? '' }}</td>
        <td class="table-cell">{{ $quadre->subseccio->subseccio ?? '' }}</td>
        <td class="table-cell">{{ $quadre->serie->serie ?? '' }}</td>
        <td class="table-cell">
          @foreach($quadre->tipologies as $tipologia)
          <span class="tag">{{ $tipologia->codi }}</span>
          @endforeach
        </td>
        @if($hasAccess)
        <td class="table-cell">
          <a href="{{ route('quadres.edit', $quadre) }}" class="btn btn-sm btn-warning">Editar</a>
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="pagination">
    {{ $quadres->links() }}
  </div>
</div>

<script>
  function sortTable(column) {
    const form = document.getElementById('filter-form');
    const currentOrderBy = form.querySelector('input[name="order_by"]').value;
    const currentOrder = form.querySelector('input[name="order"]').value;
    let newOrder = 'asc';

    if (currentOrderBy === column) {
      newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
    }

    form.querySelector('input[name="order_by"]').value = column;
    form.querySelector('input[name="order"]').value = newOrder;
    form.submit();
  }
</script>

</main>
<x-footer />
</body>
</html>
