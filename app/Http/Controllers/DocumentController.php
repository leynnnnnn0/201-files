<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentDetail;
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

        $query = DocumentDetail::query()->onlyTrashed();

        if ($search)
            $query->whereAny(
                ['name', 'office_number', 'special_number', 'person_indicated'],
                'like',
                "%$search%"
            );

        $documents = $query->latest()->paginate(10);

        return Inertia::render('Document/Archive', [
            'documents' => $documents,
            'filters' => request()->only(['search'])
        ]);
    }
    public function index()
    {
        $search = request('search');

        $query = DocumentDetail::query();

        if ($search)
            $query->whereAny(
                ['office_number', 'special_number', 'person_indicated'],
                'like',
                "%$search%"
            );

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
            'description' => ['nullable'],
            'remarks' => ['nullable'],
            'office_number' => ['nullable'],
            'special_number' => ['nullable'],
            'person_indicated' => ['required'],
            'documents' => ['required', 'array'],
            'documents.*' => ['sometimes', 'max:10000']
        ]);


        try {
            DB::beginTransaction();
            $documentDetail = DocumentDetail::create([
                'office_number' => $validated['office_number'],
                'special_number' => $validated['special_number'],
                'person_indicated' => $validated['person_indicated'],
                'description' => $validated['description'],
                'remarks' => $validated['remarks'],
            ]);

            foreach ($request->file('documents') as $document) {
                $file = $document;
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
                $uniqueName = $nameWithoutExtension . '_' . time() . '.' . $extension;
                $path = $file->storeAs('documents', $uniqueName, 'public');

                Document::create([
                    'document_detail_id' => $documentDetail->id,
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                ]);
            }
            DB::commit();
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
        $document = DocumentDetail::findOrFail($id);
        $document->delete();
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

    public function forceDelete($id)
    {
        DB::beginTransaction();
        $documentDetail = DocumentDetail::withTrashed()->with('documents')->findOrFail($id);
        foreach ($documentDetail->documents as $document) {
            if (Storage::disk('public')->exists($document->path))
                Storage::disk('public')->delete($document->path);
            $document->forceDelete();
        }
        $documentDetail->forceDelete();
        DB::commit();

        return back();
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $validated = $request->validate([
            // 'file' => ['required', 'file'],
            'name' => ['required'],
            'description' => ['nullable'],
            'remarks' => ['nullable'],
            'office_number' => ['nullable'],
            'special_number' => ['nullable'],
            'person_indicated' => ['required']
        ]);

        $path = null;

        // if ($validated['file']) {
        //     if (Storage::disk('public')->exists($document->path))
        //         Storage::disk('public')->delete($document->path);

        //     $file = $request->file('file');
        //     $originalName = $file->getClientOriginalName();
        //     $extension = $file->getClientOriginalExtension();
        //     $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
        //     $uniqueName = $nameWithoutExtension . '_' . time() . '.' . $extension;
        //     $path = $file->storeAs('documents', $uniqueName, 'public');
        // }

        $document->update([
            'office_number' => $validated['office_number'],
            'special_number' => $validated['special_number'],
            'person_indicated' => $validated['person_indicated'],
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

    public function show($id)
    {
        $documentDetail = DocumentDetail::withTrashed()->with('documents')->findOrFail($id);

        $documents = $documentDetail->documents->map(function ($item) {
            return [
                'name' => $item->name,
                'path' => $item->path,
            ];
        });
        return Inertia::render('Document/Show', [
            'document' => $documentDetail,
            'documents' => $documents
        ]);
    }
}
