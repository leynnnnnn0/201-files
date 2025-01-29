<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function index()
    {
        $search = request('search');

        $query = Document::query();

        if ($search)
            $query->where('name', 'like', "%$search%");

        $documents = $query->paginate(10)->withQueryString();

        return Inertia::render('Document/Index', [
            'documents' => $documents,
            'filters' => request()->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Document/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'file' => ['required', 'file'],
            'description' => ['nullable'],
            'remarks' => ['nullable'],
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . uniqid() . $file->getClientOriginalName();

        $path = $file->storeAs('documents', $fileName);
        $path = $request->file('file')->store('documents', 'public');

        Document::create([
            'name' => $validated['name'],
            'path' => $path,
            'description' => $validated['description'],
            'remarks' => $validated['remarks'],
        ]);

        return redirect()->route('documents.index');
    }
}
