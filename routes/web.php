<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/components/buttons', function () {
    return Inertia::render('Components/Buttons');
})->middleware(['auth', 'verified'])->name('components.buttons');

//companies resource
Route::resource('companies', 'App\Http\Controllers\CompanyController');

//customers type
Route::resource('customer-type', 'App\Http\Controllers\CustomerTypeController');

//invoice type
Route::resource('invoice-type', 'App\Http\Controllers\InvoiceTypeController');

//distributions
Route::resource('distributions', 'App\Http\Controllers\DistributionController');

//populations
Route::resource('populations', 'App\Http\Controllers\PopulationController');

//locations
Route::resource('locations', 'App\Http\Controllers\LocationController');

//invoice status
Route::resource('invoice-status', 'App\Http\Controllers\InvoiceStatusController');

//rejection codes
Route::resource('rejection-codes', 'App\Http\Controllers\RejectionCodeController');

//family
Route::resource('families', 'App\Http\Controllers\FamilyController');

//kilometer cost
Route::resource('kilometer-cost', 'App\Http\Controllers\KilometerCostController');

//company cost
Route::resource('company-cost', 'App\Http\Controllers\CompanyCostController');

//unit type
Route::resource('unit-type', 'App\Http\Controllers\UnitTypeController');

//foreign transport rates
Route::resource('foreign-transport-rates', 'App\Http\Controllers\ForeignTransportRateController');

//local transport rates
Route::resource('local-transport-rates', 'App\Http\Controllers\LocalTransportRateController');

//company travel
Route::resource('company-travel', 'App\Http\Controllers\CompanyTravelController');

//transport contacts
Route::resource('transport-contacts', 'App\Http\Controllers\TransportContactController')->except('index');
//index with type
Route::get('transport-contacts/page/{type}', 'App\Http\Controllers\TransportContactController@page')->name('transport-contacts.page');

//transport lines
Route::resource('transport-lines', 'App\Http\Controllers\TransportLineController');

//caps
Route::resource('caps', 'App\Http\Controllers\CapController');

//users
Route::resource('users', 'App\Http\Controllers\UserController');
//change password
Route::put('users/change-password/{user}', 'App\Http\Controllers\UserController@changePassword')->name('users.change-password');

require __DIR__ . '/auth.php';
