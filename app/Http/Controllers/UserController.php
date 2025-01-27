<?php

namespace App\Http\Controllers;

use App\Enum\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
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
        return Inertia::render('User/Create');
    }
}
