<?php

namespace App\Http\Controllers;

use App\Models\IctInventory;
use App\Models\IctServiceRequest;
use App\Models\IctServiceRequestStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{




    public function index()
    {
        $tickets = IctServiceRequest::with('ict_request_status')->with('requestType')->with('ict_inventory.ict_equipment_type')->where('created_by', auth()->id())->paginate(2);
        return Inertia::render('User/MyRequest', [

            'tickets' => $tickets,
            'can' => [
                'deleteUser' => Auth::user()->email === 'admin@gmail.com'
            ],
            'ict_service_request_status_id' => IctServiceRequestStatus::all(),
            'assets_1' => IctServiceRequest::with('ict_request_status')->get()->map(function ($inner) {
                return [
                    'status_name' => $inner->ict_request_status ? $inner->ict_request_status->name : null, // Access the name of the status
                ];
            }),
            'ict_service_request_status' => IctServiceRequestStatus::all(),

        ]);
    }
    public function show($id)
    {
        // Fetch the specific ticket using the provided ID
        $ticket = IctServiceRequest::with('ict_request_status', 'requestType', 'ict_inventory.ict_equipment_type')
            ->where('id', $id)
            ->where('created_by', auth()->id())
            ->firstOrFail(); // This will throw a 404 error if not found

        return Inertia::render('User/TicketDetail', [
            'ticket' => $ticket,
            'can' => [
                'deleteUser' => Auth::user()->email === 'admin@gmail.com'
            ],
            'ict_service_request_status' => IctServiceRequestStatus::all(),
        ]);
    }
}
