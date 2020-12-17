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

Route::get('/allDoctors', 'API\DoctorController@allDoctors')->name('allDoctors');

Route::get('/doctor/profile/{id}',  'DoctorController@profileDoctor');

Route::get('/patient/profile/{id}',  'DoctorController@profilePatient');

Route::post('/getSchedules', 'API\DoctorController@getSchedules')->name('getSchedules');

Route::post('/filterDoctor', 'API\DoctorController@filterDoctor');

//Route::get('/myschedules', 'API\DoctorManagerController@myschedules')->name('myschedules');

//Diseases

Route::post('/search/disease', 'API\DiseaseController@postSearch')->name('search_disease');

Route::post('diseasen/check_slug', 'API\DoctorController@check_disease_slug')->name('disease_check_slug');

Route::resource('diseases', 'API\DiseaseController');

Route::get('mydiseases', 'API\DiseaseController@mydiseases')->name('mydiseases');

Route::post('upload_file', 'API\DiseaseController@upload');

//Blog

Route::get('/blog', 'API\BlogController@blog')->name('blog');

Route::get('/latestposts', 'API\BlogController@latestposts')->name('latestposts');

Route::get('/postDetails/{slug}', 'API\BlogController@postDetails')->name('postDetails');

Route::get('categoryPosts/{slug}', 'API\BlogController@categoryPosts')->name('categoryPosts');

Route::get('categorie/check_slug', 'API\CategoryController@check_slug')->name('category_check_slug');

Route::post('postn/check_slug', 'API\DoctorController@check_slug')->name('post_check_slug');

Route::resource('categories', 'API\CategoryController');

//Doctor's Services

Route::resource('services', 'API\ServiceController');

Route::post('getServices', 'API\ServiceController@getServices');

//Doctor's specialities

Route::resource('specialities', 'API\SpecialityController');

// API private routes  
Route::middleware('auth:api')->group( function () {

    Route::post('/verifPatient', 'API\AuthController@verifPatient');

    Route::post('/verifDoctor', 'API\AuthController@verifDoctor');

    Route::get('/user', 'API\AuthController@user');

    Route::get('/logout', 'API\AuthController@logout')->name('logout');

    Route::post('updatelang', 'API\AuthController@updatelang');

    Route::resource('schedules', 'API\ScheduleController');

    Route::resource('appointments', 'API\AppointmentController');

    Route::resource('posts', 'API\PostController');

    Route::post('upload', 'API\PostController@upload');

    Route::resource('payments', 'API\PaymentController');

    //Route::get('getidentifier', 'API\PaymentController@generateIdentifier');

    //Route::post('getidentifier', 'API\PaymentController@getIdentifier');

    //Route::post('postidentifier', 'API\PaymentController@postIdentifier');

    Route::post('change_password', 'API\AuthController@change_password');

    Route::post('update_profile', 'API\AuthController@update_profile');

    Route::post('update_picture', 'API\AuthController@update_picture');

    Route::post('delete_picture', 'API\AuthController@delete_picture');

    //Notifications

    Route::resource('notifications', 'API\NotificationController');

    Route::get('myunreadnotifications', 'API\NotificationController@unread');

    //Patient Routes

    Route::get('/patientPendingapts', 'API\PatientManagerController@patientPendingapts')->name('patientPendingapts');

    Route::get('/patientUpcomingapts', 'API\PatientManagerController@patientUpcomingapts')->name('patientUpcomingapts');

    Route::get('/patientArchivedapts', 'API\PatientManagerController@patientArchivedapts')->name('patientArchivedapts');

    Route::get('/myfavourites', 'API\PatientManagerController@myfavourites')->name('myfavourites');

    Route::put('favorite/{doctor}', 'API\PatientManagerController@favoriteDoctor');

    Route::put('unfavorite/{doctor}', 'API\PatientManagerController@unFavoriteDoctor');

    Route::post('rating', 'API\PatientManagerController@rating')->name('rating');

    Route::post('/patient/post_setting', 'API\PatientManagerController@postSetting')->name('post_patient_setting');

    //Doctor Routes

    Route::post('/doctor/post_setting', 'API\DoctorManagerController@postSetting')->name('post_doctor_setting');

    //Doctor's Posts
    Route::get('/myposts', 'API\DoctorManagerController@myposts')->name('myposts');

    Route::get('/mydraftsposts', 'API\DoctorManagerController@mydraftsposts')->name('mydraftsposts');

    Route::get('/myactivatedposts', 'API\DoctorManagerController@myactivatedposts')->name('myactivatedposts');

    //Doctor's Schedules

    Route::get('/myschedules', 'API\DoctorManagerController@myschedules')->name('myschedules');

    Route::get('/myMondayschedules', 'API\DoctorManagerController@myMondayschedules')->name('myMondayschedules');

    Route::get('/myTuesdayschedules', 'API\DoctorManagerController@myTuesdayschedules')->name('myTuesdayschedules');

    Route::get('/myWednesdayschedules', 'API\DoctorManagerController@myWednesdayschedules')->name('myWednesdayschedules');

    Route::get('/myThursdayschedules', 'API\DoctorManagerController@myThursdayschedules')->name('myThursdayschedules');

    Route::get('/myFridayschedules', 'API\DoctorManagerController@myFridayschedules')->name('myFridayschedules');

    Route::get('/mySaturdayschedules', 'API\DoctorManagerController@mySaturdayschedules')->name('mySaturdayschedules');

    //Doctor's Appointments

    Route::get('/myAppointments', 'API\DoctorManagerController@myAppointments')->name('myAppointments');

    Route::get('/doctorPendingapts', 'API\DoctorManagerController@doctorPendingapts')->name('doctorPendingapts');

    Route::get('/doctorTodayapts', 'API\DoctorManagerController@doctorTodayapts')->name('doctorTodayapts');

    Route::get('/doctorUpcomingapts', 'API\DoctorManagerController@doctorUpcomingapts')->name('doctorUpcomingapts');

    Route::get('/doctorArchivedapts', 'API\DoctorManagerController@doctorArchivedapts')->name('doctorArchivedapts');

    Route::put('/take/{appointment}', 'API\DoctorManagerController@take');

    Route::put('/archivedapt/{appointment}', 'API\DoctorManagerController@archivedApt');

    Route::put('/start/{appointment}', 'API\DoctorManagerController@start');

    Route::put('/finish/{appointment}', 'API\DoctorManagerController@finish');

    //Doctor's Patients

    Route::get('/myPatients', 'API\DoctorManagerController@myPatients')->name('myPatients');

});

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
