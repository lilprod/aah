<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// public routes
Route::post('registerpatient', 'API\AuthController@registerPatient');

Route::post('registerdoctor', 'API\AuthController@registerDoctor');

Route::post('loginpatient', 'API\AuthController@loginPatient');

Route::post('logindoctor', 'API\AuthController@loginDoctor');

Route::post('checkemail', 'API\AuthController@checkemail');

Route::post('checkphone', 'API\AuthController@checkphone');

Route::post('posttoken', 'API\AuthController@postToken');

Route::post('forgot_password', 'API\AuthController@forgot_password');

Route::post('resetpassword', 'API\AuthController@resetpassword');

Route::post('postverify', 'API\AuthController@postVerify');

Route::post('resendcode', 'API\AuthController@postCode');

Route::post('updatephone', 'API\AuthController@updatephone');

//Blog

Route::get('/blog', 'API\BlogController@blog')->name('blog');

Route::get('/latestposts', 'API\BlogController@latestposts')->name('latestposts');

Route::get('/postDetails/{slug}', 'API\BlogController@postDetails')->name('postDetails');

Route::get('categoryPosts/{slug}', 'API\BlogController@categoryPosts')->name('categoryPosts');

Route::resource('services', 'API\ServiceController');

Route::resource('specialities', 'API\SpecialityController');

Route::resource('categories', 'API\CategoryController');
// private routes  
Route::middleware('auth:api')->group( function () {

    Route::get('/logout', 'API\AuthController@logout')->name('logout');

    Route::post('updatelang', 'API\AuthController@updatelang');

    Route::resource('schedules', 'API\ScheduleController');

    Route::resource('appointments', 'API\AppointmentController');

    Route::resource('posts', 'API\PostController');

    Route::resource('payments', 'API\PaymentController');

    //Route::get('getidentifier', 'API\PaymentController@generateIdentifier');

    //Route::post('getidentifier', 'API\PaymentController@getIdentifier');

    //Route::post('postidentifier', 'API\PaymentController@postIdentifier');

    Route::post('change_password', 'API\AuthController@change_password');

    Route::post('update_profile', 'API\AuthController@update_profile');

    Route::post('update_picture', 'API\AuthController@update_picture');

    Route::post('delete_picture', 'API\AuthController@delete_picture');

    //Patient Routes

    Route::get('/myfavourites', 'API\PatientManagerController@myfavourites')->name('myfavourites');

    Route::post('favorite/{doctor}', 'API\PatientManagerController@favoriteDoctor');

    Route::post('unfavorite/{doctor}', 'API\PatientManagerController@unFavoriteDoctor');

    Route::post('rating', 'API\PatientManagerController@rating')->name('rating');

    //Doctor Routes

    Route::get('/myposts', 'API\DoctorManagerController@myposts')->name('myposts');

    Route::get('/mydraftsposts', 'API\DoctorManagerController@mydraftsposts')->name('mydraftsposts');

    Route::get('/myactivatedposts', 'API\DoctorManagerController@myactivatedposts')->name('myactivatedposts');

    Route::get('/myschedules', 'API\DoctorManagerController@myschedules')->name('myschedules');

    Route::get('/myMondayschedules', 'API\DoctorManagerController@myMondayschedules')->name('myMondayschedules');

    Route::get('/myTuesdayschedules', 'API\DoctorManagerController@myTuesdayschedules')->name('myTuesdayschedules');

    Route::get('/myWednesdayschedules', 'API\DoctorManagerController@myWednesdayschedules')->name('myWednesdayschedules');

    Route::get('/myThursdayschedules', 'API\DoctorManagerController@myThursdayschedules')->name('myThursdayschedules');

    Route::get('/myFridayschedules', 'API\DoctorManagerController@myFridayschedules')->name('myFridayschedules');

    Route::get('/mySaturdayschedules', 'API\DoctorManagerController@mySaturdayschedules')->name('mySaturdayschedules');

    Route::get('/myAppointments', 'API\DoctorManagerController@myAppointments')->name('myAppointments');

    Route::get('/myPatients', 'API\DoctorManagerController@myPatients')->name('myPatients');

    Route::put('/finish/{appointment}', 'API\DoctorManagerController@finish')->name('finish');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
