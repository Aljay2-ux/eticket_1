<?php

namespace App\Http\Controllers;

use App\Models\IctInventory;
use App\Models\IctServiceRequestStatus;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DefectConfirmationController extends Controller
{
    public function index(Request $request){
        return Inertia::render('User/Index/Defect', [
            'assets' => IctInventory::where("id", $request->input("asset_id"))->get()->map(
                function ($inner) { 
                    return [
                        'code' => $inner->code,
                        'equipment_type' => $inner->ict_equipment_type->name,
                        'date_acquired' => $inner->date_acquired,
                        

                    ];
                }

            ),
            'ict_service_request_status_id' => IctServiceRequestStatus::all(),
            
        ]);
    }
}
