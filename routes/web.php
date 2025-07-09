<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IctServiceRequestController;
use App\Http\Controllers\MisDirectorController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\UserController;
use App\Models\IctInventory;
use App\Models\IctServiceRequest;
use App\Models\IctServiceRequestType;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified','role:admin'
// ])->group(function () {
//     Route::get('/admin/dashboard', function(){
//         return Inertia::render('Admin/AdminDashboard');
//     })->name('admin.dashboard');
// });

// Route::middleware(['auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified','role:admin'])->group(function(){
//     Route::get('/admin/admin', [AdminController::class, 'index'])->name('admin');
// });

// Route::group('/admin', function () {
//     return Inertia::render('Admin/AdminDashboard');
// })->middleware(['auth', 'role:admin'])->name('admin');

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


Route::group(['middleware' => ['auth', 'role:user']], function () {


    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/myrequest', function () {
        return Inertia::render('User/MyRequest', [
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
    })->name('my-request');
    Route::get('/request', function () {
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
            ),


        ]);
    })->name('request');

    Route::get('/request/defect', function (Request $request) {

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
            'request_types' => IctServiceRequestType::all(),
            'asset_id' => $request->input("asset_id"),
            // 'asset_name' => $request->input("asset_name"),


        ]);
    });

    Route::get('/request/defect/date', function (Request $request) {
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
        ]);     
    });

    Route::post('/request/defect/date', [IctServiceRequestController::class, 'store']);
    Route::get('/request/defect/date/confirmation', function () {
        return Inertia::render('User/Index/Confirmation');
    });
    
});

Route::group(['middleware' => ['auth', 'role:mis-director']], function () {


    Route::get('/misdirector/dashboard', [MisDirectorController::class, 'index'])->name('mis-director.dashboard');

});

Route::group(['middleware' => ['auth', 'role:technician']], function () {


    Route::get('/technician/dashboard', [TechnicianController::class, 'index'])->name('technician.dashboard');

});

// ,'role:admin'
Route::group(['middleware' => ['auth', 'redirect.role']], function () {

    Route::get('/dashboard', function () {})->name('dashboard');
});
