<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DesignationController extends Controller
{
    public function index()
    {
        return Inertia::render('Designation/Index');
    }
}
