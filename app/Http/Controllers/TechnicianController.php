<?php

namespace App\Http\Controllers;

use App\Models\IctServiceRequest;
use App\Models\IctTechnician;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TechnicianController extends Controller
{
    public function index()
    {
        return Inertia::render('Technician/TechnicianDashboard',  [
            // 'tech' => IctTechnician::get()->map(
            //     function ($inner) {
            //         return [
            //             'tech_id' => $inner->employee->id,
            //             'technicians' => $inner->employee->last_name . " " . $inner->employee->first_name

            //         ];
            //     }
            // ),
            
            'request_list' => IctServiceRequest::with('ict_technician')->with('ict_request_status')->with('requestType')->with('ict_inventory.ict_equipment_type')->with('employee.division')->where('ict_request_status_id', '5')->paginate(2),
        ]);

    }
}
