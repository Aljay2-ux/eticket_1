<?php

namespace App\Http\Controllers;

use App\Models\IctServiceRequest;
use App\Models\IctServiceRequestStatus;
use App\Models\IctServiceRequestType;
use App\Models\IctTechnician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class MisDirectorController extends Controller
{
    // public function index()
    // {
    //     return Inertia::render('MisDirector/MisDirectorDashboard', [
    //         'can' => [
    //             'deleteUser' => Auth::user()->email === 'admin@gmail.com'
    //         ],

    //         'technicians' => IctTechnician::get()->map(
    //             function ($inner) {
    //                 return [

    //                     'technicianss' => $inner->employee->last_name . " " . $inner->employee->first_name

    //                 ];
    //             }
    //         ),
    //         'request_types' => IctServiceRequestType::all(),
    //         'assets_1' => IctServiceRequest::paginate(3),
    //         'ict_service' => IctServiceRequest::all(),
    //         'ict_service' => DB::table('ict_service_requests')->paginate(3),
    //         'ict_technicians' => IctTechnician::all(),
    //         'ict_service_request_status_id' => IctServiceRequestStatus::all(),


    //     ]);
    // }

    public function index()
    {
        // $tickets = IctServiceRequest::with('ict_request_status')->with('requestType')->with('ict_inventory.ict_equipment_type')->with('employee.division')->where('id')->paginate(2);
        // return Inertia::render('User/MyRequest', [

        //     'tickets' => $tickets,
        //     'can' => [
        //         'deleteUser' => Auth::user()->email === 'admin@gmail.com'
        //     ],
        //     'ict_service_request_status_id' => IctServiceRequestStatus::all(),
        //     'assets_1' => IctServiceRequest::with('ict_request_status')->get()->map(function ($inner) {
        //         return [
        //             'status_name' => $inner->ict_request_status ? $inner->ict_request_status->name : null, // Access the name of the status
        //         ];
        //     }),
        //     'ict_service_request_status' => IctServiceRequestStatus::all(),

        // ]);

        return Inertia::render('MisDirector/MisDirectorDashboard', [
            'tech' => IctTechnician::get()->map(
                function ($inner) {
                    return [
                        'tech_id' => $inner->employee->id,
                        'technicians' => $inner->employee->last_name . " " . $inner->employee->first_name

                    ];
                }
            ),
            
            'request_list' => IctServiceRequest::with('ict_technician')->with('ict_request_status')->with('requestType')->with('ict_inventory.ict_equipment_type')->with('employee.division')->where('ict_request_status_id', '4')->paginate(2),
        ]);
    }

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

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            // 'description_of_request' => 'required|string',
            // 'ict_service_request_type_id' => 'required|exists:ict_service_request_types,id',
            // 'ict_inventory_id' => 'required|exists:ict_inventories,id',
            // 'requested_by' => 'required|required|exists:users,name',
            // 'date_needed' => 'required|date',
            // 'created_by' => 'required|exists:users,id',
            'ict_technician_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        IctServiceRequest::where('id', $request->input('request_id'))->first();
        // IctServiceRequest::create($request->all());
        // $serviceRequest = IctServiceRequest::create($request->all());

        // return response()->json($serviceRequest, 201);

        return (IctServiceRequest::where('id', $request->input('request_id'))->first());
    }

//    public function storeTechnician(Request $request)
// {
//     // Validate the incoming request data
//     $validator = Validator::make($request->all(), [
//         'ict_technician_id' => 'required|exists:ict_request_requests,id', // Ensure technician ID exists
//         'request_id' => 'required|exists:ict_service_requests,id', // Ensure request ID exists
//     ]);

//     // Check for validation errors
//     if ($validator->fails()) {
//         return response()->json($validator->errors(), 422);
//     }

//     // Find the service request by ID
//     $serviceRequest = IctServiceRequest::find($request->input('request_id'));

//     // Check if the service request exists
//     if (!$serviceRequest) {
//         return response()->json(['message' => 'Service request not found'], 404);
//     }

//     // Update the service request with the technician ID
//     $serviceRequest->ict_technician_id = $request->input('ict_technician_id');
//     $serviceRequest->save(); // Save changes

//     // Return a success response
//     return response()->json([
//         'message' => 'Technician assigned successfully!',
//         'data' => $serviceRequest, // Return the updated data
//     ], 200);
// }

// public function storeTechnician(Request $request)
// {
//     try {
//         \Log::info('Incoming request data:', $request->all());

//         // Validate the incoming request data
//         $validator = Validator::make($request->all(), [
//             'ict_technician_id' => 'required|exists:ict_technicians,id',
//             'request_id' => 'required|exists:ict_service_requests,id',
//         ]);

//         // Check for validation errors
//         if ($validator->fails()) {
//             return response()->json($validator->errors(), 422);
//         }

//         // Find the service request by ID
//         $serviceRequest = IctServiceRequest::find($request->input('request_id'));

//         // Check if the service request exists
//         if (!$serviceRequest) {
//             return response()->json(['message' => 'Service request not found'], 404);
//         }

//         // Update the service request with the technician ID
//         $serviceRequest->ict_technician_id = $request->input('ict_technician_id');
//         $serviceRequest->save(); // Save changes

//         // Return a success response
//         return response()->json([
//             'message' => 'Technician assigned successfully!',
//             'data' => $serviceRequest,
//         ], 200);
//     } catch (\Exception $e) {
//         \Log::error('Error assigning technician: ' . $e->getMessage());
//         return response()->json(['message' => 'An error occurred.'], 500);
//     }
// }
}
