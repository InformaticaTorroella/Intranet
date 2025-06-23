<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Crear Document</title>
    <link rel="stylesheet" href="{{ asset('css/documents.css') }}">
</head>
<body>
    <x-header />

    <h1 class="form-title">Crear Document</h1>
<!-- PER DEBUGEJAR EL ERROR DE PUJAR EL FITXER en el inspector del navegador el comentari es va actualitzant mostrant els errors
    {{-- Missatges d'error --}}
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Missatge d'èxit --}}
    @if (session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif
-->
    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="form-label">Nom Visual:</label>
        <input class="form-control" type="text" name="nom_visual" value="{{ old('nom_visual') }}" required>

        <label class="form-label">Fitxer (PDF, DOCX, etc):</label>
        <input class="form-control" type="file" name="file" required>

        <label class="form-label">Data Entrada:</label>
        <input class="form-control" type="datetime-local" name="data_entrada" value="{{ old('data_entrada') }}" required>

        <label class="form-label">Ordre:</label>
        <input class="form-control" type="number" name="ordre" value="{{ old('ordre') }}" required>

        <label class="form-label">ID Objecte:</label>
        <input class="form-control" type="number" name="fk_id_obj" value="{{ old('fk_id_obj') }}" required>

        <label class="form-label">Tipus Objecte:</label>
        <input class="form-control" type="number" name="fk_id_tipus_obj" value="{{ old('fk_id_tipus_obj') }}" required>

        <button class="btn btn-primary" type="submit">Crear Document</button>
    </form> 

    <x-footer />
</body>
</html>
