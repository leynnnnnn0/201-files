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
use App\OfficesColleges;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Enum\Position as PositionEnum;

class EmployeeController extends Controller
{
    public function archive()
    {
        $search = request('search');

        $query = Employee::query()->onlyTrashed()->with('documents');

        if ($search)
            $query->whereAny(['first_name', 'last_name', 'id', 'office_colleges', 'position'], 'like', "%$search%");

        $employees = $query->paginate(10)->withQueryString();

        return Inertia::render('Employee/Archive', [
            'employees' => $employees,
            'filters' => request()->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $employees = Employee::onlyTrashed()->findOrFail($id);
        $employees->restore();
        return to_route('archives.employees');
    }

    public function index()
    {
        $search = request('search');

        $query = Employee::query()->with('documents');

        if ($search)
            $query->whereAny(['first_name', 'last_name', 'id', 'position', 'office_colleges'], 'like', "%$search%");

        $employees = $query->orderBy('last_name', 'asc')->paginate(10)->withQueryString();

        return Inertia::render('Employee/Index', [
            'employees' => $employees,
            'filters' => request()->only(['search'])
        ]);
    }

    public function create()
    {
        $positions = PositionEnum::options();
        $designations = Designation::getOptions();
        $officesColleges = OfficesColleges::options();

        $employmentClassifications = EmploymentClassification::options();
        $statuses = Status::options();
        $sexes = Sex::options();

        return Inertia::render('Employee/Create', [
            'positions' => $positions,
            'designations' => $designations,
            'employmentClassifications' => $employmentClassifications,
            'statuses' => $statuses,
            'sexes' => $sexes,
            'officesColleges' => $officesColleges
        ]);
    }

    public function store(StoreEmployeeRequest $request)
    {
        try {
            DB::beginTransaction();

            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . $file->getClientOriginalName();

            $path = $file->storeAs('profiles', $fileName);
            $path = $file->store('profiles', 'public');

            $validated = $request->validated();
            $validated['image'] = $path;
            $employee = Employee::create(attributes: Arr::except($validated, 'document'));


            if ($request->validated()['documents']) {
                foreach ($request->file('documents') as $document) {
                    $file = $document;
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
                    $uniqueName = $nameWithoutExtension . '_' . time() . '.' . $extension;
                    $path = $file->storeAs('documents', $uniqueName, 'public');

                    $document = Document::create([
                        'owner_id' => $employee->id,
                        'name' => $file->getClientOriginalName(),
                        'path' => $path,
                    ]);
                }
            }
            DB::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
        }
        return to_route('employees.index');
    }

    public function edit($id)
    {
        $positions = PositionEnum::options();
        $designations = Designation::getOptions();
        $employmentClassifications = array_column(EmploymentClassification::cases(), 'value');
        $officesColleges = OfficesColleges::options();
        $employmentClassifications = EmploymentClassification::options();
        $statuses = Status::options();
        $sexes = Sex::options();
        $employee = Employee::with('documents')->findOrFail($id);

        $documents = $employee->documents->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'path' => $item->path,
            ];
        });
        return Inertia::render('Employee/Edit', [
            'positions' => $positions,
            'designations' => $designations,
            'employmentClassifications' => $employmentClassifications,
            'statuses' => $statuses,
            'sexes' => $sexes,
            'employee' => $employee,
            'documents' => $documents,
            'officesColleges' => $officesColleges,
            'image' => Storage::url($employee->image)
        ]);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();
        if ($validated['image']) {

            $file = $request->file('image');

            $fileName = time() . '_' . uniqid() . $file->getClientOriginalName();

            $path = $file->storeAs('profiles', $fileName);
            $path = $file->store('profiles', 'public');


            $validated = $request->validated();
            $validated['image'] = $path;

            if (Storage::disk('public')->exists($employee->image))
                Storage::disk('public')->delete($employee->image);
        } else {
            unset($validated['image']);
        }


        $employee->update(Arr::except($validated, 'removed_documents'));
        if (isset($validated['removed_documents']))
            foreach ($validated['removed_documents'] as $document) {
                $document = Document::findOrFail($document);
                $document->delete();
                if (Storage::disk('public')->exists($document->path))
                    Storage::disk('public')->delete($document->path);
            }

        return to_route('employees.index');
    }



    public function show($id)
    {
        $employee = Employee::with('documents')->withTrashed()->findOrFail($id);



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
            'office_colleges' => $employee->office_colleges,
            'position' => $employee->position,
            'documents' => $documents,
            'address' => $employee->address,
            'philhealth_id' => $employee->philhealth_id,
            'pag_ibig_id' => $employee->pag_ibig_id,
            'tin_id' => $employee->tin_id,
            'gsis_id' => $employee->gsis_id,
            'image' => Storage::url($employee->image)
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
