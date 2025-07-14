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
        $tickets = IctServiceRequest::with('ict_request_status')->with('requestType')->with('ict_inventory.ict_equipment_type')->with('employee.division')->where('created_by', auth()->id())->paginate(2);
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
    // public function show($id)
    // {
    //     // Fetch the specific ticket using the provided ID
    //     $ticket = IctServiceRequest::with('ict_request_status', 'requestType', 'ict_inventory.ict_equipment_type')
    //         ->where('id', $id)
    //         ->where('created_by', auth()->id())
    //         ->firstOrFail(); // This will throw a 404 error if not found

    //     return Inertia::render('User/TicketDetail', [
    //         'ticket' => $ticket,
    //         'can' => [
    //             'deleteUser' => Auth::user()->email === 'admin@gmail.com'
    //         ],
    //         'ict_service_request_status' => IctServiceRequestStatus::all(),
    //     ]);
    // }

    public function showTicket(Request $request)
    {
        $ticket = IctServiceRequest::where('id', $request->input('request_id'))->first();

        // Check if the ticket exists
        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        // Call the mapping function
        return response()->json($this->mapTicket($ticket));
    }

    private function mapTicket(IctServiceRequest $ticket)
    {
        // Map the ticket data to a desired format
        return [
            'id' => $ticket->id,
            'created_by' => $ticket->created_by,
            'description' => $ticket->description_of_request,
            'type_id' => $ticket->ict_service_request_type_id,
            'inventory_id' => $ticket->ict_inventory_id,
            'requested_by' => $ticket->requested_by,
            'created_at' => $ticket->created_at->toDateTimeString(),
            'updated_at' => $ticket->updated_at->toDateTimeString(),
            'date_needed' => $ticket->date_needed,
            'date_approved' => $ticket->date_approved,
            'date_completed' => $ticket->date_completed,
            'date_requested' => $ticket->date_requested,
            'description_of_request' => $ticket->description_of_request,
            'ict_request_status' => $ticket->ict_request_status ? $ticket->ict_request_status->name : null,
            'request_type' => $ticket->requestType ? $ticket->requestType->name : null,
            'division' => $ticket->employee->division ? $ticket->employee->division->name : null,
            // Add any other fields you want to include
        ];
    }
}
