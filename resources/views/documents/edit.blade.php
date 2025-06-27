<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Document</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/documents.css') }}">
</head>
<body>
    <x-header />
    <h1 class="form-title">Editar Document</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('documents.update', $document->id) }}">
        @csrf
        @method('PUT')

        <label class="form-label">Nom</label>
        <input type="text" name="nom_visual" class="form-control" value="{{ old('nom_visual', $document->nom_visual) }}" required>

        <label class="form-label">Nom del Arxiu</label>
        <input type="text" name="nom_arxiu" class="form-control" value="{{ old('nom_arxiu', $document->nom_arxiu) }}">

        <label class="form-label">Data Entrada</label>
        <input type="datetime-local" name="data_entrada" class="form-control" value="{{ old('data_entrada', $document->data_entrada ? date('Y-m-d\TH:i', strtotime($document->data_entrada)) : '') }}">

        <label class="form-label">Extensió</label>
        <input type="text" name="extensio" maxlength="10" class="form-control" value="{{ old('extensio', $document->extensio) }}">

        <label class="form-label">Ordre</label>
        <input type="number" name="ordre" class="form-control" value="{{ old('ordre', $document->ordre) }}">

        <label class="form-label">URL</label>
        <input type="text" name="url" class="form-control" value="{{ old('url', $document->url) }}">

        <label class="form-label">FK ID Obj</label>
        <input type="number" name="fk_id_obj" class="form-control" value="{{ old('fk_id_obj', $document->fk_id_obj) }}">

        <label class="form-label">FK ID Tipus Obj</label>
        <input type="number" name="fk_id_tipus_obj" class="form-control" value="{{ old('fk_id_tipus_obj', $document->fk_id_tipus_obj) }}">

        <button type="submit" class="btn btn-primary">Guardar</button>
        
        <button class="btn-go-back" type="button" onclick="window.location.href='{{ route('documents.index') }}'">Tornar</button>
    </form>

    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="margin-top: 1rem;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Segur que vols eliminar aquest document?')">Eliminar</button>
    </form>

    <x-footer />
</body>
</html>
