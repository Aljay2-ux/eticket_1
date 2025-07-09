<?php

namespace App\Http\Controllers;

use App\Models\IctServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('User/MyRequest' , [
            'can' => [
                'deleteUser' => Auth::user()->email === 'admin@gmail.com'
            ],
            'assets_1' => IctServiceRequest::get()->map(
                function ($inner) {
                    return [
                        'requested_by' => $inner->requested_by,
                        'date_requested' => $inner->date_requested,
                        'date_completed' => $inner->date_completed,
                        'remarks' => $inner->remarks,
                        'date_needed' => $inner->date_needed,
                        'ict_technician_id' => $inner->ict_technician ? ($inner->ict_technician->employee ?
                            $inner->ict_technician->employee->last_name . " " . $inner->ict_technician->employee->first_name
                            : 'No Employee Assigned') : 'No Technician Assigned',
                        'request_type' => $inner->requestType->name,
                        'description' => $inner->description_of_request

                    ];
                }
            ),
            'assets_2' => IctServiceRequest::all()


        ]);
    }
}
