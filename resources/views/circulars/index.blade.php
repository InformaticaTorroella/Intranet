<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Circulars</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/circulars.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .circular-description {
            padding: 8px 20px;
            color: #333;
            font-size: 14px;
            border-left: 3px solid #007BFF;
            margin: 10px 0;
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.circular-header').forEach(header => {
                header.addEventListener('click', () => {
                    const arrow = header.querySelector('.toggle-arrow');
                    const descDiv = header.nextElementSibling;
                    const filesDiv = descDiv.nextElementSibling;
                    const isVisible = filesDiv.style.display === 'block';

                    if (isVisible) {
                        filesDiv.style.display = 'none';
                        descDiv.style.display = 'none';
                        arrow.classList.remove('rotate');
                    } else {
                        filesDiv.style.display = 'block';
                        descDiv.style.display = 'block';
                        arrow.classList.add('rotate');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <x-header />

    @php $userGroups = session('user_groups', []); @endphp

    <div class="documents-page-center">
        <section class="documents-container">
            <h1>Circulars</h1>

            <form method="GET" action="{{ route('circulars.index') }}" class="category-filter-form">
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
            </form>

            <div>
                @forelse ($circulars as $circular)
                    <div class="circular-row">
                        <div class="circular-header" role="button" tabindex="0" aria-expanded="false" aria-controls="files-{{ $circular->id }}">
                            <i class="fas fa-chevron-right toggle-arrow"></i>
                            <div class="circular-date">{{ \Carbon\Carbon::parse($circular->data_entrada)->format('d/m/Y H:i') }}</div>
                            <div class="circular-name" title="{{ $circular->nom_visual }}">{{ $circular->nom_visual }}</div>
                            <div class="actions">
                                @if(session()->has('username') && in_array('Intranet_Documents', $userGroups))
                                    <a href="{{ route('circulars.edit', ['id' => $circular->id]) }}" class="btn-action btn-edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('circulars.destroy', $circular->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Segur?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <div class="circular-description">{!! $circular->descripcion !!}</div>

                        <div class="circular-files" id="files-{{ $circular->id }}" style="display:none;">
                            @forelse ($circular->files as $file)
                                <div class="file-entry">
                                    <div class="file-name">{{ $file->nom_arxiu }}</div>
                                    <div class="file-actions">
                                        <a href="{{ asset('storage/' . $file->url) }}" class="btn-action btn-view" title="Veure {{ $file->nom_arxiu }}" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ asset('storage/' . $file->url) }}" class="btn-action btn-download" title="Descarregar {{ $file->nom_arxiu }}" download>
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div style="padding-left:20px; font-style: italic;">No hi ha fitxers.</div>
                            @endforelse
                        </div>
                    </div>
                @empty
                    <p>No hi ha circulars disponibles.</p>
                @endforelse
            </div>

            @if(session()->has('username') && in_array('Intranet_Documents', $userGroups))
                <a href="{{ route('circulars.create') }}" class="btn-create">Crear Circular</a>
            @endif

            <div class="pagination">
                {{ $circulars->links() }}
            </div>
        </section>
    </div>

    <x-footer />
</body>
</html>
