<?php

namespace App\Http\Controllers;

use App\Enum\EmploymentClassification;
use App\Enum\Sex;
use App\Enum\Status;
use App\Models\Designation;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{

    public function archive()
    {
        $search = request('search');

        $query = User::query()->onlyTrashed();

        if ($search)
            $query->whereAny(['first_name', 'last_name'], 'like', "%$search%");
        $users = $query->latest()->paginate(10)->withQueryString();

        return Inertia::render('User/Archive', [
            'users' => $users,
            'filters' => request()->only(['search'])
        ]);
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return to_route('archives.users');
    }
    public function index()
    {
        $search = request('search');

        $query = User::query();

        if ($search)
            $query->whereAny(['first_name', 'last_name'], 'like', "%$search%");
        $users = $query->latest()->paginate(10)->withQueryString();

        return Inertia::render('User/Index', [
            'users' => $users,
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
        return Inertia::render('User/Create', [
            'positions' => $positions,
            'designations' => $designations,
            'employmentClassifications' => $employmentClassifications,
            'statuses' => $statuses,
            'sexes' => $sexes,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'email' => ['required', 'unique:users,email'],
        ]);

        $validated['password'] = Hash::make('password');

        User::create($validated);

        return to_route('users.index');
    }

    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        return Inertia::render('User/Show', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'email' => ['required', 'unique:users,email,' . $user->id],
        ]);
        $user->update($validated);
        return to_route('users.index');
    }

    public function edit(User $user)
    {

        $positions = Position::getOptions();
        $designations = Designation::getOptions();
        $employmentClassifications = array_column(EmploymentClassification::cases(), 'value');
        $employmentClassifications = EmploymentClassification::options();
        $statuses = Status::options();
        $sexes = Sex::options();
        return Inertia::render('User/Edit', [
            'positions' => $positions,
            'designations' => $designations,
            'employmentClassifications' => $employmentClassifications,
            'statuses' => $statuses,
            'sexes' => $sexes,
            'user' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
