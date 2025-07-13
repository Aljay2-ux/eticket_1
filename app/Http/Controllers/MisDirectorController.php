<?php

namespace App\Http\Controllers;

use App\Models\IctServiceRequest;
use App\Models\IctServiceRequestStatus;
use App\Models\IctServiceRequestType;
use App\Models\IctTechnician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MisDirectorController extends Controller
{
    public function index()
    {
        return Inertia::render('MisDirector/MisDirectorDashboard', [
            'can' => [
                'deleteUser' => Auth::user()->email === 'admin@gmail.com'
            ],

            'technicians' => IctTechnician::get()->map(
                function ($inner) {
                    return [

                        'technicianss' => $inner->employee->last_name . " " . $inner->employee->first_name

                    ];
                }
            ),
            'request_types' => IctServiceRequestType::all(),
            'assets_1' => IctServiceRequest::paginate(3),
            'ict_service' => IctServiceRequest::all(),
            'ict_service' => DB::table('ict_service_requests')->paginate(3),
            'ict_technicians' => IctTechnician::all(),
            'ict_service_request_status_id' => IctServiceRequestStatus::all(),


        ]);
    }
}
