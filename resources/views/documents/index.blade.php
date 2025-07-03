<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Documents</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/documents.css') }}">
</head>
<body>
    <x-header />

    @php
        $userGroups = session('user_groups', []);
    @endphp

    <div class="documents-page-center">
        <section class="documents-container">
            <h1>Documents</h1>

            <!-- Filtro de categoría -->
            <form method="GET" action="{{ route('documents.index') }}" class="category-filter-form">
                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria" onchange="this.form.submit()">
                    <option value="">Totes</option>
                    @foreach ($categories as $categoria)
                        <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nom }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="nom" id="nomInput" placeholder="Cerca per nom..." value="{{ request('nom') }}" class="search-input">

                @if(session()->has('username') && in_array('Intranet_Telefons', $userGroups))
                    <a href="{{ route('categoria-documents.create') }}" class="btn-secondary">Afegir Categoria</a>
                @endif
            </form>


            <!-- Llista de documents -->
            <table class="documents-table">
            <thead>
                <tr>
                <th>Nom</th>
                <th>Data entrada</th>
                <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documents as $document)
                <tr>
                    <td>{{ $document->nom_visual }}</td>
                    <td>{{ \Carbon\Carbon::parse($document->data_entrada)->format('d/m/Y H:i') }}</td>
                    <td class="actions">
                    <a href="{{ route('documents.view', ['id' => $document->id, 'action' => 'view']) }}"
                        class="btn-action btn-view" title="Veure" target="_blank">
                        <i class="icon-eye fas fa-eye"></i>
                    </a>
                    <a href="{{ route('documents.view', ['id' => $document->id]) }}"
                        class="btn-action btn-download" title="Descarregar">
                        <i class="icon-download fas fa-download"></i>
                    </a>
                    @if(session()->has('username') && in_array('Intranet_Documents', $userGroups))
                        <a href="{{ route('documents.edit', ['id' => $document->id]) }}"
                        class="btn-action btn-edit" title="Editar">
                        <i class="icon-edit fas fa-edit"></i>
                        </a>
                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST"
                            class="inline-form" onsubmit="return confirm('Segur?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" title="Eliminar">
                            <i class="icon-trash fas fa-trash"></i>
                        </button>
                        </form>
                    @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4">No hi ha documents disponibles.</td></tr>
                @endforelse
            </tbody>
            </table>

            @if(session()->has('username') && in_array('Intranet_Documents', $userGroups))
            <a href="{{ route('documents.create') }}" class="btn-create">Crear Document</a>
            @else
            <p>No tens permisos per crear documents. Contacta amb l’administrador.</p>
            @endif
        </section>
        </div>


    <x-footer />
    <script>
        const nomInput = document.getElementById('nomInput');
        const filterForm = document.getElementById('filter-form');

        let timeout = null;

        nomInput.addEventListener('input', function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
            filterForm.submit();
            }, 300);
        });
    </script>

</body>
</html>
