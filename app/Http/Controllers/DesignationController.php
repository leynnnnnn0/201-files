<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DesignationController extends Controller
{
    public function index()
    {
        $data = Designation::latest()->paginate(10)->withQueryString();
        return Inertia::render('Designation/Index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return Inertia::render('Designation/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:designations,name'],
            'remarks' => ['nullable']
        ]);

        Designation::create($validated);

        return to_route('designations.index');
    }
}
