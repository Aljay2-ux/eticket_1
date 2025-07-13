<?php

namespace App\Http\Controllers;

use App\Models\IctInventory;
use App\Models\IctServiceRequestStatus;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RequestController extends Controller
{
    public function index(){
        return Inertia::render('User/Index/RequestForm', [
            'assets' => IctInventory::get()->map(
                function ($inner) {
                    return [
                        'code' => $inner->code,
                        'equipment_type' => $inner->ict_equipment_type->name,
                        'date_acquired' => $inner->date_acquired,
                        'id' => $inner->id,
                        'serial_no' => $inner->serial_no,
                    ];
                }
            ),'ict_service_request_status' => IctServiceRequestStatus::all(),


        ]);
    }
}
