<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Llistat de Areas</title>
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
</head>
<body>
<x-header />

<main class="categories-page-center">
    <div class="categories-container">
        <h1>Areas</h1>

        @if(session('success'))
            <div class="category-success-message">{{ session('success') }}</div>
        @endif

        <div class="button-container">
            <a href="{{ route('area-telefons.create') }}" class="new-category-button">
                + Nova Categoria
            </a>
            <a href="{{ route('telefons.index') }}" class="new-category-button">
                Tornar
            </a>
        </div>

        <table class="categories-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Edifici</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($areas as $area)
                    <tr>
                        <td>{{ $area->IdArea }}</td>
                        <td>{{ $area->Area }}</td>
                        <td>{{ $area->Equipament->Equipament ?? 'No té Edifici' }}</td>
                        <td>
                            <div class="category-action-links">
                                <a href="{{ route('area-telefons.edit', $area->IdArea) }}" class="btn-editar">Editar</a>
                                <form action="{{ route('area-telefons.destroy', $area->IdArea) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger" onclick="return confirm('Segur que vols eliminar aquesta categoria?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hi ha categories.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

<x-footer />
</body>
</html>
