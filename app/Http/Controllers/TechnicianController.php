<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TechnicianController extends Controller
{
    public function index()
    {
        return Inertia::render('Technician/TechnicianDashboard');

    }
}
