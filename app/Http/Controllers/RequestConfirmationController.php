<?php

namespace App\Http\Controllers;

use App\Models\IctServiceRequestStatus;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RequestConfirmationController extends Controller
{
    public function index(){
        return Inertia::render('User/Index/Confirmation');
    }
}
