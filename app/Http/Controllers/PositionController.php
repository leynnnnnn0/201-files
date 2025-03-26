<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PositionController extends Controller
{
    public function index()
    {
        $search = request('search');

        $query = Position::query();

        if ($search)
            $query->where('name', 'like', "%$search%");

        $data = $query->paginate(10)->withQueryString();
        return Inertia::render('Position/Index', [
            'data' => $data,
            'filters' => request()->only(['search'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Position/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:positions,name'],
            'remarks' => ['nullable']
        ]);

        Position::create($validated);

        return to_route('positions.index');
    }

    public function edit($id)
    {
        $designation = Position::findOrFail($id);
        return Inertia::render('Position/Edit', [
            'designation' => $designation
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:positions,name,' . $id],
            'remarks' => ['nullable']
        ]);

        Position::findOrFail($id)->update($validated);

        return to_route('positions.index');
    }

    public function destroy($id)
    {
        $designation = Position::findOrFail($id);
        $designation->delete();

        return back();
    }
}
