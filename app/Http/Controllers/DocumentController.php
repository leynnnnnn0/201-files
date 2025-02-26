<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function archive()
    {
        $search = request('search');

        $query = Document::query()->onlyTrashed();

        if ($search)
            $query->where('name', 'like', "%$search%");

        $documents = $query->latest()->paginate(10);

        return Inertia::render('Document/Archive', [
            'documents' => $documents,
            'filters' => request()->only(['search'])
        ]);
    }
    public function index()
    {
        $search = request('search');

        $query = Document::query()->with(['employee'])->where('owner_id', null);

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
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');
        ini_set('memory_limit', '256M');
        $validated = $request->validate([
            'name' => ['required'],
            'file' => ['required', 'file', 'mimes:pdf',  'max:10240'],
            'description' => ['nullable'],
            'remarks' => ['nullable'],
        ], [
            'file.mimes' => 'The file must be a PDF document.',
            'file.required' => 'Please upload a file.',
            'file.file' => 'The uploaded file is invalid.',
            'file.max' => 'The file size cannot exceed 10MB.'
        ]);


        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
        $uniqueName = $nameWithoutExtension . '_' . time() . '.' . $extension;
        $path = $file->storeAs('documents', $uniqueName, 'public');


        try {
            Document::create([
                'name' => $validated['name'],
                'path' => $path,
                'description' => $validated['description'],
                'remarks' => $validated['remarks'],
            ]);
        } catch (Exception $e) {
            dd($e);
        }

        return redirect()->route('documents.index');
    }

    public function storeDocuments(Request $request)
    {

        $validated = $request->validate([
            'employee_id' => ['required'],
            'documents' => ['required', 'array'],
            'documents.*' => ['required', 'mimes:pdf', 'max:10000']
        ], [
            'documents.mimes' => 'The documents must be a PDF.',
        ]);

        DB::beginTransaction();
        foreach ($request->file('documents') as $document) {
            $file = $document;
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
            $uniqueName = $nameWithoutExtension . '_' . time() . '.' . $extension;
            $path = $file->storeAs('documents', $uniqueName, 'public');


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
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
            $uniqueName = $nameWithoutExtension . '_' . time() . '.' . $extension;
            $path = $file->storeAs('documents', $uniqueName, 'public');
        }

        $document->update([
            'name' => $validated['name'],
            'path' => $path ?? $document->path,
            'description' => $validated['description'],
            'remarks' => $validated['remarks'],
        ]);

        return redirect()->route('documents.index');
    }

    public function restore($id)
    {
        $documents = Document::onlyTrashed()->findOrFail($id);
        $documents->restore();
        return to_route('archives.documents');
    }
}
