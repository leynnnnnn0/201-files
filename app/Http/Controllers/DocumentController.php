<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function index()
    {
        $search = request('search');

        $query = Document::query()->with(['employee']);

        if ($search)
            $query->where('name', 'like', "%$search%");

        $documents = $query->latest()->paginate(10);

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

    public function storeDocuments(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => ['required'],
            'documents' => ['required', 'array']
        ]);

        DB::beginTransaction();
        foreach ($request->file('documents') as $document) {
            $file = $document;
            $fileName = time() . '_' . uniqid() . $file->getClientOriginalName();

            $path = $file->storeAs('documents', $fileName);
            $path = $document->store('documents', 'public');

            $document = Document::create([
                'owner_id' => $validated['employee_id'],
                'name' => $file->getClientOriginalName(),
                'path' => $path,
            ]);
        }
        DB::commit();
        to_route('employees.index');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $document = Document::findOrFail($id);
        $document->delete();
        if (Storage::disk('public')->exists($document->path))
            Storage::disk('public')->delete($document->path);
        DB::commit();

        return redirect()->route('documents.index');
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);

        return Inertia::render('Document/Edit', [
            'document' => $document
        ]);
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $validated = $request->validate([
            'file' => ['required', 'file'],
            'name' => ['required'],
            'description' => ['nullable'],
            'remarks' => ['nullable'],
        ]);

        $path = null;

        if ($validated['file']) {
            if (Storage::disk('public')->exists($document->path))
                Storage::disk('public')->delete($document->path);

            $file = $request->file('file');
            $fileName = time() . '_' . uniqid() . $file->getClientOriginalName();

            $path = $file->storeAs('documents', $fileName);
            $path = $request->file('file')->store('documents', 'public');
        }

        $document->update([
            'name' => $validated['name'],
            'path' => $path ?? $document->path,
            'description' => $validated['description'],
            'remarks' => $validated['remarks'],
        ]);

        return redirect()->route('documents.index');
    }
}
