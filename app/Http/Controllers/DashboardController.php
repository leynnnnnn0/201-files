<?php

namespace App\Http\Controllers;

use App\Models\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $sexCounts = Employee::select('sex', DB::raw('count(*) as count'))
            ->groupBy('sex')
            ->pluck('count', 'sex');




        return Inertia::render('Dashboard', [
            'sexCounts' => $sexCounts
        ]);
    }
}
