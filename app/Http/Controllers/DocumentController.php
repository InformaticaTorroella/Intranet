<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::orderBy('ordre', 'asc')->get();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_visual' => 'required|string|max:200',
            'nom_arxiu' => 'nullable|string|max:200',
            'data_entrada' => 'required|date',
            'extensio' => 'nullable|string|max:10',
            'ordre' => 'required|integer',
            'url' => 'nullable|string|max:230',
            'fk_id_obj' => 'nullable|integer',
            'fk_id_tipus_obj' => 'nullable|integer',
            'trial695' => 'nullable|string|size:1',
        ]);

        $document = new Document();
        $document->nom_visual = $validated['nom_visual'];
        $document->nom_arxiu = $validated['nom_arxiu'] ?? null;
        $document->data_entrada = $validated['data_entrada'];
        $document->extensio = $validated['extensio'] ?? null;
        $document->ordre = $validated['ordre'];
        $document->url = $validated['url'] ?? null;
        $document->fk_id_obj = $validated['fk_id_obj'] ?? null;
        $document->fk_id_tipus_obj = $validated['fk_id_tipus_obj'] ?? null;
        $document->trial695 = $validated['trial695'] ?? null;
        $document->save();

        return redirect()->route('documents.index')->with('success', 'Document creat');
    }

    public function edit($id)
    {
        $document = Document::find($id);
        if (!$document) abort(404);
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom_visual' => 'required|string|max:200',
            'nom_arxiu' => 'nullable|string|max:200',
            'data_entrada' => 'required|date',
            'extensio' => 'nullable|string|max:10',
            'ordre' => 'required|integer',
            'url' => 'nullable|string|max:230',
            'fk_id_obj' => 'nullable|integer',
            'fk_id_tipus_obj' => 'nullable|integer',
            'trial695' => 'nullable|string|size:1',
        ]);

        $document = Document::findOrFail($id);
        $document->nom_visual = $validated['nom_visual'];
        $document->nom_arxiu = $validated['nom_arxiu'] ?? null;
        $document->data_entrada = $validated['data_entrada'];
        $document->extensio = $validated['extensio'] ?? null;
        $document->ordre = $validated['ordre'];
        $document->url = $validated['url'] ?? null;
        $document->fk_id_obj = $validated['fk_id_obj'] ?? null;
        $document->fk_id_tipus_obj = $validated['fk_id_tipus_obj'] ?? null;
        $document->trial695 = $validated['trial695'] ?? null;
        $document->save();

        return redirect()->route('documents.index')->with('success', 'Document actualitzat');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document eliminat');
    }

    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.show', compact('document'));
    }
}
