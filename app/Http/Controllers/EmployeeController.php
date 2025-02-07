<?php

namespace App\Http\Controllers;

use App\Enum\EmploymentClassification;
use App\Enum\Sex;
use App\Enum\Status;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Designation;
use App\Models\Document;
use App\Models\Employee;
use App\Models\Position;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        $search = request('search');

        $query = Employee::query()->with('documents');

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

        try {
            DB::beginTransaction();
            $employee = Employee::create(attributes: Arr::except($request->validated(), 'document'));

            $file = $request->file('document');
            $fileName = time() . '_' . uniqid() . $file->getClientOriginalName();

            $path = $file->storeAs('documents', $fileName);
            $path = $request->file(key: 'document')->store('documents', 'public');
            $file = $request->file('document');


            $employee->documents()->create([
                'name' => $fileName,
                'path' => $path,
            ]);
            DB::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
        }
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

    public function show(Employee $employee)
    {
        $employee->load(['documents']);

        $documents = $employee->documents->map(function ($item) {
            return [
                'name' => $item->name,
                'path' => $item->path,
            ];
        });
        $employee = [
            'first_name' => $employee->first_name,
            'middle_name' => $employee->middle_name,
            'last_name' => $employee->last_name,
            'email' => $employee->email,
            'phone_number' => $employee->phone_number,
            'employment_classification' => $employee->employment_classification,
            'status' => $employee->status,
            'sex' => $employee->sex,
            'designation' => $employee->designation,
            'position' => $employee->position,
            'documents' => $documents
        ];
        return Inertia::render('Employee/Show', [
            'employee' => $employee
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return back();
    }
}
