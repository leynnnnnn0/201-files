<?php

namespace App\Http\Controllers;

use App\Enum\EmploymentClassification;
use App\Enum\Sex;
use App\Enum\Status;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Position;
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

    public function create()
    {
        $positions = Position::getOptions();
        $designations = Designation::getOptions();
        $employmentClassifications = array_column(EmploymentClassification::cases(), 'value');
        $employmentClassifications = EmploymentClassification::options();
        $statuses = Status::options();
        $sexes = Sex::options();
        return Inertia::render('Employee/Create', [
            'positions' => $positions,
            'designations' => $designations,
            'employmentClassifications' => $employmentClassifications,
            'statuses' => $statuses,
            'sexes' => $sexes,
        ]);
    }

    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->validated());
        return to_route('employees.index');
    }

    public function edit($id)
    {
        $positions = Position::getOptions();
        $designations = Designation::getOptions();
        $employmentClassifications = array_column(EmploymentClassification::cases(), 'value');
        $employmentClassifications = EmploymentClassification::options();
        $statuses = Status::options();
        $sexes = Sex::options();
        $employee = Employee::findOrFail($id);
        return Inertia::render('Employee/Edit', [
            'positions' => $positions,
            'designations' => $designations,
            'employmentClassifications' => $employmentClassifications,
            'statuses' => $statuses,
            'sexes' => $sexes,
            'employee' => $employee
        ]);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return to_route('employees.index');
    }
}
