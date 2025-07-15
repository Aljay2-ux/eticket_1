<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DateAndTimeConfirmationController;
use App\Http\Controllers\DefectConfirmationController;
use App\Http\Controllers\IctServiceRequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MisDirectorController;
use App\Http\Controllers\RequestConfirmationController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\UserController;
use App\Models\IctInventory;
use App\Models\IctServiceRequest;
use App\Models\IctServiceRequestStatus;
use App\Models\IctServiceRequestType;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect'])
//     ->where('provider', 'google');

// Route::get('/auth/{provider}/callback', [SocialController::class, 'callback'])
//     ->where('provider', 'google');

// Route::get('login', [LoginController::class, 'create'])->name('login');
// Route::post('login', [LoginController::class, 'store']);

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

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


Route::group(['middleware' => ['auth', 'role:user']], function () {

    Route::post('/view/request', [UserController::class, 'showTicket'])->name('view.request');
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/request', [RequestController::class, 'index'])->name('request.dashboard');
    Route::get('/request/defect', [DefectConfirmationController::class, 'index'])->name('defect.dashboard');
    Route::get('/request/defect/date', [DateAndTimeConfirmationController::class, 'index'])->name('date.dashboard');
    Route::get('request/defect/date/confirmation', [RequestConfirmationController::class, 'index']);
    Route::post('/request/defect/date', [DateAndTimeConfirmationController::class, 'store']);
    // Route::get('/tickets/{id}', [UserController::class, 'show']);
});

Route::group(['middleware' => ['auth', 'role:mis-director']], function () {


    Route::get('/misdirector/dashboard', [MisDirectorController::class, 'index'])->name('mis-director.dashboard');
    Route::post('/store/technician', [MisDirectorController::class, 'store'])->name('store.technician');
    Route::post('/view/request_list', [UserController::class, 'showTicket'])->name('view.request_list');
});

Route::group(['middleware' => ['auth', 'role:technician']], function () {


    Route::get('/technician/dashboard', [TechnicianController::class, 'index'])->name('technician.dashboard');
    Route::get('/submit/dashboard', function() {
        return Inertia::render('Technician/CompletedWork');
    })->name('hey.dashboard');
});

// ,'role:admin'
Route::group(['middleware' => ['auth', 'redirect.role']], function () {

    Route::get('/dashboard', function () {})->name('dashboard');
});
