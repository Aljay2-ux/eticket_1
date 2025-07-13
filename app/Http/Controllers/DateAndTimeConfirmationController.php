<?php

namespace App\Http\Controllers;

use App\Models\IctInventory;
use App\Models\IctServiceRequest;
use App\Models\IctServiceRequestType;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class DateAndTimeConfirmationController extends Controller
{
   public function index(Request $request){
         $asset = IctInventory::where("id", $request->input("asset_id"))->first();
        
        // Check if the asset was found
        if ($asset) {
            $assetData = [
                'code' => $asset->code,
                'equipment_type' => $asset->ict_equipment_type->name,
                'date_acquired' => $asset->date_acquired,
            ];
        } else {
            // Handle the case where the asset is not found
            $assetData = null;
        }

        return Inertia::render('User/Index/Date', [
            'assets' => $assetData,
            'request_types' => IctServiceRequestType::all(),
            'ict_inventory_id' => $request->input("asset_id"),
            'requested_by' => $request->input("requested_by"),
            'ict_service_request_type_id' => $request->input("ict_service_request_type_id"),
            'description_of_request'  => $request->input('description_of_request'),
            'ict_service_request_status_id' => IctInventory::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description_of_request' => 'required|string',
            'ict_service_request_type_id' => 'required|exists:ict_service_request_types,id',
            'ict_inventory_id' => 'required|exists:ict_inventories,id',
            'requested_by' => 'required|required|exists:users,name',
            'date_needed' => 'required|date',
            'created_by' => 'required|exists:users,id',
            // 'ict_technician_id' => 'required|exists:ict_technicians,id'

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // IctServiceRequest::create($validator);
        IctServiceRequest::create($request->all());
        // $serviceRequest = IctServiceRequest::create($request->all());

        // return response()->json($serviceRequest, 201);

        return redirect('/request/defect/date/confirmation')->with('success', 'Request Submitted');
    }
}
