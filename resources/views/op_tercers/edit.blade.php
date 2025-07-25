<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Tercer {{ $op_tercer->ter_doc }}</title>
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/op.css') }}">
</head>
<body>
    <x-header />
    <div class="container">
        <h1 class="page-title">Editar Tercer {{ $op_tercer->ter_doc }}</h1>

        <form action="{{ route('op_tercers.update', $op_tercer) }}" method="POST" class="form-grid">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="ter_doc">Document (ter_doc):</label>
                <input type="text" name="ter_doc" id="ter_doc" class="form-select" value="{{ old('ter_doc', $op_tercer->ter_doc) }}" required maxlength="20" readonly>
                @error('ter_doc') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="ter_nom">Nom (ter_nom):</label>
                <input type="text" name="ter_nom" id="ter_nom" class="form-select" value="{{ old('ter_nom', $op_tercer->ter_nom) }}" required maxlength="255">
                @error('ter_nom') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="ter_dom">Adreça (ter_dom):</label>
                <input type="text" name="ter_dom" id="ter_dom" class="form-select" value="{{ old('ter_dom', $op_tercer->ter_dom) }}" maxlength="255">
                @error('ter_dom') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="ter_pob">Població (ter_pob):</label>
                <input type="text" name="ter_pob" id="ter_pob" class="form-select" value="{{ old('ter_pob', $op_tercer->ter_pob) }}" maxlength="100">
                @error('ter_pob') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="ter_cpo">Codi Postal (ter_cpo):</label>
                <input type="number" name="ter_cpo" id="ter_cpo" class="form-select" value="{{ old('ter_cpo', $op_tercer->ter_cpo) }}">
                @error('ter_cpo') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="ter_pro">Provincia (ter_pro):</label>
                <input type="text" name="ter_pro" id="ter_pro" class="form-select" value="{{ old('ter_pro', $op_tercer->ter_pro) }}" maxlength="100">
                @error('ter_pro') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="ter_tlf">Telèfon (ter_tlf):</label>
                <input type="text" name="ter_tlf" id="ter_tlf" class="form-select" value="{{ old('ter_tlf', $op_tercer->ter_tlf) }}" maxlength="50">
                @error('ter_tlf') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="ter_fax">Fax (ter_fax):</label>
                <input type="text" name="ter_fax" id="ter_fax" class="form-select" value="{{ old('ter_fax', $op_tercer->ter_fax) }}" maxlength="50">
                @error('ter_fax') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="ter_dce">DCE (ter_dce):</label>
                <input type="text" name="ter_dce" id="ter_dce" class="form-select" value="{{ old('ter_dce', $op_tercer->ter_dce) }}" maxlength="255">
                @error('ter_dce') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Actualitzar</button>
        </form>

        <p><a href="{{ route('op_tercers.index') }}" class="btn btn-secondary">Tornar enrere</a></p>
    </div>
    <x-footer />
</body>
</html>
