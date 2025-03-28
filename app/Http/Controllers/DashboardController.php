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
        $totalEmployees = Employee::count();

        $sexCounts = Employee::select('sex', DB::raw('count(*) as count'))
            ->groupBy('sex')
            ->get()
            ->mapWithKeys(function ($item) use ($totalEmployees) {
                $percentage = ($item->count / $totalEmployees) * 100;
                return [$item->sex => [
                    'count' => $item->count,
                    'percentage' => round($percentage, 2)
                ]];
            });


        $statuses = Employee::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) use ($totalEmployees) {
                $percentage = ($item->count / $totalEmployees) * 100;
                $camelStatus = Str::camel($item->status);
                return [$camelStatus => [
                    'count' => $item->count,
                    'percentage' => round($percentage, 2)
                ]];
            });

        $classifications = Employee::select('employment_classification', DB::raw('count(*) as count'))
            ->groupBy('employment_classification')
            ->get()
            ->mapWithKeys(function ($item) use ($totalEmployees) {
                $percentage = ($item->count / $totalEmployees) * 100;
                return [$item->employment_classification => [
                    'count' => $item->count,
                    'percentage' => round($percentage, 2)
                ]];
            });


        $documentsCount = ModelsDocument::count();
        $employeesCount = $totalEmployees;
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
