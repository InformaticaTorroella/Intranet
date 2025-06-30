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

            @forelse ($documents as $document)
                <article class="document">
                    <h2 class="document-nom_visual">{{ $document->nom_visual }}</h2>
                    <p class="document-nom_arxiu">Fitxer: {{ $document->nom_arxiu }}</p>
                    <p class="document-data_entrada">Data Entrada: {{ \Carbon\Carbon::parse($document->data_entrada)->format('d/m/Y H:i') }}</p>
                    <p class="document-extensio">Extensió: {{ $document->extensio }}</p>
                    <p class="document-ordre">Ordre: {{ $document->ordre }}</p>
                    <p class="document-fk_id_obj">ID Objecte: {{ $document->fk_id_obj }}</p>
                    <p class="document-fk_id_tipus_obj">Tipus Objecte: {{ $document->fk_id_tipus_obj }}</p>
                    <a href="{{ route('documents.view', ['id' => $document->id, 'action' => 'view']) }}" target="_blank" class="btn-veure">Veure</a>
                    <a href="{{ route('documents.view', ['id' => $document->id]) }}" class="btn-descarregar">Descarregar</a>



                    @if(session()->has('username') && in_array('Intranet_Documents', $userGroups) && isset($document->id))
                        <a href="{{ route('documents.edit', ['id' => $document->id]) }}" class="btn-editar">Editar</a>
                    @endif
                </article>
            @empty
                <p>No hi ha documents disponibles.</p>
            @endforelse

            @if(session()->has('username') && in_array('Intranet_Documents', $userGroups) && isset($document->id))
                <a href="{{ route('documents.create') }}" class="btn-crear">Crear Document</a>
            @else
                <p>
                  No tens permisos per crear documents. <br>
                  Si vols crear un document, contacta amb el teu administrador.
                </p>
            @endif
        </section>
    </div>
    <x-footer />
</body>
</html>
