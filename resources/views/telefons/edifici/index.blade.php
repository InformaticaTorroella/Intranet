<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <title>Llistat de Edificis</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
</head>
<body>
<x-header />

<main class="categories-page-center">
    <div class="categories-container">
        <h1>Edificis</h1>

        @if(session('success'))
            <div class="category-success-message">{{ session('success') }}</div>
        @endif

        <div class="button-container">
            <a href="{{ route('edifici-telefons.create') }}" class="new-category-button">
                + Nou Edifici
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
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipaments as $equipament)
                    <tr>
                        <td>{{ $equipament->id_equimanent }}</td>
                        <td>{{ $equipament->Equipament }}</td>
                        <td>
                            <div class="category-action-links">
                                <a href="{{ route('edifici-telefons.edit', $equipament->id_equimanent) }}" class="btn-editar">Editar</a>
                                <form action="{{ route('edifici-telefons.destroy', $equipament->id_equimanent) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger" onclick="return confirm('Segur que vols eliminar aquest edifici?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No hi ha edificis.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $equipaments->links() }}
        </div>
    </div>
</main>

<x-footer />
</body>
</html>
