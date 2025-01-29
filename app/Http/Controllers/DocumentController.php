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
}
