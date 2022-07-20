<?php

use App\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::get('/', [HomeController::class, 'index']);
Route::get('/laminated', [HomeController::class, 'laminated']);

Route::get('/production/{id}/{IDNoFontSize}/{nameFontSize}/{positionFontSize}/{addressFontSize}/{officeFontSize}/{pictureSize}/', [HomeController::class, 'production']);
Route::get('/production/big/{id}/{IDNoFontSize}/{nameFontSize}/{positionFontSize}/{addressFontSize}/{officeFontSize}/{pictureSize}/', [HomeController::class, 'bigProduction']);
Route::get('/export-signature/{id}/', [HomeController::class, 'exportSignature']);

Route::get('/export-image', function () {
    $employees = Employee::get(['Employee_id', 'ImagePhoto']);
    foreach ($employees as $employee) {
        file_put_contents(public_path('assets\\IDpictures\\' . $employee->Employee_id . '.jpg'), $employee->ImagePhoto);
    }
});

Route::get('/export-image/{id}', function ($id) {
    $employees = Employee::where('Employee_id', $id)->first(['Employee_id', 'ImagePhoto']);
    $export = file_put_contents(public_path('assets\\IDpictures\\' . $employees->Employee_id . '.jpg'), $employees->ImagePhoto);
    
    if($export == false){
        return false;
    }else{
        return true;
    }
});

Route::get('/export-signature/{id}', function ($id) {
    $employees = Employee::where('Employee_id', $id)->first(['Employee_id', 'signaturephoto']);
    $export = file_put_contents(public_path('assets\\SIGNATURES\\' . $employees->Employee_id . '.jpg'), $employees->signaturephoto);
    
    if($export == false){
        return false;
    }else{
        return true;
    }
});


Route::get('/export-signature', function () {
    $employees = Employee::get(['Employee_id', 'signaturephoto']);
    foreach ($employees as $employee) {
        file_put_contents(public_path('assets\\SIGNATURES\\' . $employee->Employee_id . '.jpg'), $employee->signaturephoto);
    }
});
