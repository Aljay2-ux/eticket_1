<?php

namespace App\Http\Controllers;

use App\Models\IctServiceRequestStatus;
use Illuminate\Http\Request;

class RequestConfirmationController extends Controller
{
    public function index(){
       $serviceRequestStatuses = IctServiceRequestStatus::all();

    // Dump and die to inspect the data
    dd($serviceRequestStatuses);


    }
}
