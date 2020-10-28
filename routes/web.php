<?php

use Illuminate\Support\Facades\Route;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Admin;


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

//Admin Auth
Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {

    Route::get('login', 'AdminAuthController@getLogin')->name('login');

    Route::post('login', 'AdminAuthController@postLogin');

    Route::get('dashboard', 'AdminDashboardController@adminHome')->name('dashboard');

    Route::post('logout', 'AdminAuthController@postLogout')->name('logout');
});


Route::get('admin/reviews', 'AdminReviewController@index')->name('admin.reviews');

Route::delete('admin/reviewsdelete/{id}', 'AdminReviewController@destroy')->name('admin.reviewsDelete');
//Route::get('/login/doctor', 'Auth\LoginController@showDoctorLoginForm');

Route::get('/register/doctor', 'Auth\RegisterController@showDoctorRegisterForm')->name('register_doctor');

//Route::post('/login/doctor', 'Auth\LoginController@doctorLogin');

Route::post('/register/doctor', 'Auth\RegisterController@createDoctor');

Route::get('/getDoctors', 'PagesController@getDoctors')->name('getDoctors');

//Route::post('/takeup', 'DoctorManagerController@takeUp')->name('takeUp');

Route::post('/take/{id}', ['as' => 'take', 'uses' => 'DoctorManagerController@take']);

Route::post('/finish/{id}', ['as' => 'finish', 'uses' => 'DoctorManagerController@finish']);

Route::post('/checkup', 'AppointmentController@check')->name('checkUp');

Route::post('/archivedapt', 'DoctorManagerController@archivedApt')->name('archivedapt');


//Video Chat
//Route::get('/home', 'HomeController@index')->name('home');
/*Route::get('/chat/{id}', 'VideoChatController@chat')->name('videochat');
Route::get('/group/chat/{id}', 'VideoChatController@groupChat')->name('group.chat');

Route::post('/chat/message/send', 'VideoChatController@send')->name('chat.send');
Route::post('/chat/message/send/file', 'VideoChatController@sendFilesInConversation')->name('chat.send.file');
Route::post('/group/chat/message/send', 'VideoChatController@groupSend')->name('group.send');
Route::post('/group/chat/message/send/file', 'VideoChatController@sendFilesInGroupConversation')->name('group.send.file');
*/


# Socialite URLs

// La page où on présente les liens de redirection vers les providers
//Route::get("login-register", "SocialiteController@loginRegister");

// La redirection vers le provider
Route::get('redirect/{provider}', 'SocialiteController@redirect')->name('socialite.redirect');

// Le callback du provider
Route::get('redirect/{provider}/callback', 'SocialiteController@callback')->name('socialite.callback');


Route::get('/accept/message/request/{id}' , function ($id){
    Chat::acceptMessageRequest($id);
    return redirect()->back();
})->name('accept.message');

Route::post('/trigger/{id}' , function (\Illuminate\Http\Request $request , $id) {
    Chat::startVideoCall($id , $request->all());
});

Route::post('/group/chat/leave/{id}' , function ($id) {
    Chat::leaveFromGroupConversation($id);
});


//Administrations

/*Route::group(['prefix' => 'admin'], function() {

  
Route::get('events/{event}/remind/{user}', [
'as' => 'remindHelper', 'uses' => 'EventsController@remindHelper']);
View:

route('remindHelper',['event'=>$eventId,'user'=>$userId]);
    
});*/

Route::resource('ratings', 'RatingController');

Route::resource('specialities', 'SpecialityController');

Route::resource('doctors', 'DoctorController');

Route::resource('patients', 'PatientController');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

Route::resource('categories', 'CategoryController');

Route::resource('schedules', 'ScheduleController');

Route::resource('appointments', 'AppointmentController');

Route::resource('services', 'ServiceController');

Route::resource('drugs', 'DrugController');

Route::resource('drugtypes', 'DrugTypeController');

Route::resource('prescriptions', 'PrescriptionController');

Route::resource('prescriptiontypes', 'PrescriptionTypeController');
//Patients Routes

Route::get('/patient/profile_setting', 'PatientManagerController@setting')->name('patient_profile_setting');

Route::post('/patient/post_setting', 'PatientManagerController@postSetting')->name('post_patient_setting');

Route::get('/patient/profile/{id}', ['as' => 'patient.profile', 'uses' => 'PatientManagerController@profile']);

Route::get('/patient/booking/{id}', ['as' => 'booking.doctor', 'uses' => 'PatientManagerController@booking']);

Route::get('/patient/rating/{id}', ['as' => 'rating.doctor', 'uses' => 'PatientManagerController@rating']);

Route::get('/patient/booking/success/{appointment}/{doctor}', ['as' => 'booking.success', 'uses' => 'AppointmentController@success']);

Route::get('/getSchedules', 'PatientManagerController@getSchedules')->name('getSchedules');

Route::get('/patient/change_password', 'PatientManagerController@changePassword')->name('patient_change_password');

Route::post('/patient/update_password', 'PatientManagerController@updatePassword')->name('patient_update_password');

//Doctors Routes

Route::get('/doctor/profile_setting', 'DoctorManagerController@setting')->name('doctor_profile_setting');

Route::post('/doctor/post_setting', 'DoctorManagerController@postSetting')->name('post_doctor_setting');

Route::get('/doctor/profile/{id}', ['as' => 'doctor.profile', 'uses' => 'DoctorManagerController@profile']);

Route::get('/doctor/change_password', 'DoctorManagerController@changePassword')->name('doctor_change_password');

Route::post('/doctor/update_password', 'DoctorManagerController@updatePassword')->name('doctor_update_password');

Route::get('/doctor/my_appointments', 'DoctorManagerController@myAppointments')->name('doctor_my_appointments');

Route::get('/doctor/my_patients', 'DoctorManagerController@myPatients')->name('doctor_my_patients');

Route::get('/doctor/reviews', 'DoctorManagerController@reviews')->name('doctor_reviews');

Route::get('/doctor/my_invoices', 'DoctorManagerController@myInvoices')->name('doctor_my_invoices');

Route::get('/doctor/pending_posts', 'PostController@pending')->name('doctor_pending_posts');

Route::get('/doctor/startapt/{id}', ['as' => 'appointment.start', 'uses' => 'DoctorManagerController@start']);

//Admin Routes
Route::get('changeStatus', 'DoctorController@ChangeUserStatus')->name('changeStatus');

/*Route::middleware('auth:admin')->group(function(){
  //here all your admin routes
    Route::resource('users', 'UserController');

    Route::resource('roles', 'RoleController');

    Route::resource('permissions', 'PermissionController');
});*/

/*Route::get('/create_role_permission', function () {
    $role = Role::create(['name' => 'Admin']);
    $permission = Permission::create(['name' => 'Admin Permissions']);
    auth()->user()->assignRole('Admin');
    auth()->user()->givePermissionTo('Admin Permissions');


    $admin = new Admin();
    $admin->name = 'KOSSIGAN';
    $admin->firstname = 'Prodige';
    $admin->email = 'pkossigan@gmail.com';
    $admin->password = Hash::make('prodige93');
    $admin->phone_number = 22893343699;
    $admin->address = 'Lomé-Togo';
    $admin->profile_picture = 'avatar.jpg';
    $admin->save();
       
});*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::post('favorite/{doctor}', 'PatientManagerController@favoriteDoctor');

Route::post('unfavorite/{doctor}', 'PatientManagerController@unFavoriteDoctor');

Route::get('my_favourites', 'PatientManagerController@myFavorites')->middleware('auth');

Route::get('/', 'PagesController@index')->name('home');

Route::get('/about-us', 'PagesController@about')->name('about');

Route::get('/our-services', 'PagesController@services')->name('services');

Route::get('/contact-us', 'PagesController@contact')->name('contact');

Route::get('/search', 'SearchController@search')->name('search');

Route::post('/search', 'SearchController@postSearch')->name('search');

Route::get('/blog', 'PagesController@blog')->name('blog');

Route::get('/our-doctors', 'PagesController@doctors')->name('our_doctors');

Route::get('/terms', 'PagesController@terms')->name('terms');

Route::get('/policy', 'PagesController@policy')->name('policy');

Route::get('/faq', 'PagesController@faq')->name('faq');

Route::post('/loadmore/load_data', 'PagesController@load_data')->name('loadmore.load_data');

//Route::get('/blog-details', 'PagesController@blogDetail')->name('blogdetails');

Route::get('post/{slug}', ['as' => 'blog.show', 'uses' => 'PagesController@postDetails']);

Route::get('category/{slug}', ['as' => 'categoryPosts', 'uses' => 'PagesController@categoryPosts']);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('categorie/check_slug', 'CategoryController@check_slug')
  ->name('category.check_slug');

  Route::get('postn/check_slug', 'PostController@check_slug')
  ->name('post.check_slug');


//Chat
//Route::get('/chat', 'ChatController@index')->name('chat');

Route::get('/messages', 'ChatController@fetchAllMessages');

Route::post('/messages', 'ChatController@sendMessage');

//Messages

Route::get('/load-latest-messages', 'MessagesController@getLoadLatestMessages');
 
Route::post('/send', 'MessagesController@postSendMessage');

Route::get('/fetch-old-messages', 'MessagesController@getOldMessages');

//Video Chat

Route::group(['middleware' => 'auth'], function(){

  Route::get('video_chat', 'VideoChatController@index')->name('video_chat');

  Route::post('auth/video_chat', 'VideoChatController@auth');
});

//Route::get('admin/dashboard', 'DashboardController@adminHome')->name('admin.dashboard');

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
});