<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        $search = request('search');

        $query = Employee::query()->with(['position', 'designation']);

        if ($search)
            $query->whereAny(['first_name', 'last_name'], 'like', "%$search%");
        $employees = $query->latest()->paginate(10)->withQueryString();

        return Inertia::render('Employee/Index', [
            'employees' => $employees,
            'filters' => request()->only(['search'])
        ]);
    }
}
