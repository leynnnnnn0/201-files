<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DesignationController extends Controller
{
    public function index()
    {
        $search = request('search');

        $query = Designation::query();

        if ($search)
            $query->where('name', 'like', "%$search%");

        $data = $query->latest()->paginate(10)->withQueryString();
        return Inertia::render('Designation/Index', [
            'data' => $data,
            'filters' => request()->only(['search'])
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

    public function edit($id)
    {
        $designation = Designation::findOrFail($id);
        return Inertia::render('Designation/Edit', [
            'designation' => $designation
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:designations,name,' . $id],
            'remarks' => ['nullable']
        ]);

        Designation::findOrFail($id)->update($validated);

        return to_route('designations.index');
    }

    public function destroy($id)
    {
        $designation = Designation::findOrFail($id);
        $designation->delete();

        return back();
    }
}
