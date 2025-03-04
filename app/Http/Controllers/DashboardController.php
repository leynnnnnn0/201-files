<?php

namespace App\Http\Controllers;

use App\Models\Document as ModelsDocument;
use App\Models\Employee;
use App\Models\User;
use Dom\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $sexCounts = Employee::select('sex', DB::raw('count(*) as count'))
            ->groupBy('sex')
            ->pluck('count', 'sex');

        $statuses = Employee::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) {
                $camelStatus = Str::camel($item->status);
                return [$camelStatus => $item->count];
            });

        $classifications = Employee::select('employment_classification', DB::raw('count(*) as count'))
            ->groupBy('employment_classification')
            ->get()
            ->pluck('count', 'employment_classification');

        $documentsCount = ModelsDocument::count();
        $employeesCount = Employee::count();
        $usersCount = User::count();


        return Inertia::render('Dashboard', [
            'sexCounts' => $sexCounts,
            'statuses' => $statuses,
            'classifications' => $classifications,
            'counts' => [
                'documents' => $documentsCount,
                'employees' => $employeesCount,
                'users' => $usersCount,
            ]

        ]);
    }
}
