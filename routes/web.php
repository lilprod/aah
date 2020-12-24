<?php

use Illuminate\Support\Facades\Route;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

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

//Video Chat

Route::get('/video-chat', function () {

    // fetch all users apart from the authenticated user

    $users = User::where('id', '<>', Auth::id())
                  ->where('role_id', '<>', auth()->user()->role_id)
                  ->where('role_id', '<>', 3)
                  ->get();

    return view('video_chat.index', ['users' => $users]);
})->name('video_chat')->middleware('auth');

// Endpoints to call or receive calls.

Route::post('/video/call-user', 'VideoChatController@callUser');

Route::post('/video/accept-call', 'VideoChatController@acceptCall');

/*Route::group(['middleware' => 'auth'], function(){

  Route::get('video_chat', 'VideoChatController@index')->name('video_chat');

  Route::post('auth/video_chat', 'VideoChatController@auth');
});*/


//PDF

Route::get('patient/{id}/prescriptionInvoice', ['as' => 'prescription.invoice', 'uses' => 'PatientManagerController@pdfexport']);

Route::get('patient/{id}/invoice', ['as' => 'patient.invoice', 'uses' => 'PatientManagerController@pdfInvoice']);

//Account Verification

Route::get('/verify', 'VerifyController@getVerify')->name('getVerify');

Route::post('/verify', 'VerifyController@postVerify')->name('verify');

//Paypal

Route::post('paypal/payment', 'PaypalController@payment')->name('payment');

Route::get('paypal/cancel', 'PaypalController@cancel')->name('payment.cancel');

Route::get('paypal/success', 'PaypalController@success')->name('payment.success');

//Stripe

Route::get('/stripe/{id}', ['as' => 'stripe', 'uses' => 'StripeController@stripe']);

//Route::get('stripe', 'StripeController@stripe')->name('stripe');

Route::post('stripe', 'StripeController@stripePost')->name('stripe.post');

//Admin Auth
Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {

    Route::get('login', 'AdminAuthController@getLogin')->name('login');

    Route::post('login', 'AdminAuthController@postLogin');

    Route::get('dashboard', 'AdminDashboardController@adminHome')->name('dashboard');

    Route::post('logout', 'AdminAuthController@postLogout')->name('logout');
});

// Admin Doctors reviews

Route::get('admin/reviews', 'AdminReviewController@index')->name('admin.reviews');

Route::delete('admin/reviewsdelete/{id}', 'AdminReviewController@destroy')->name('admin.reviewsDelete');

//Admin Post

Route::get('admin/active/posts', 'AdminPostController@index')->name('admin.posts');

Route::get('admin/pending/posts', 'AdminPostController@pending')->name('admin.pending_posts');

Route::get('admin/posts/{id}', 'AdminPostController@show')->name('admin_posts_show');

Route::delete('admin/posts_delete/{id}', 'AdminPostController@delete')->name('admin_posts_delete');

Route::get('admin/create/posts', 'AdminPostController@create')->name('admin_posts_create');

Route::get('admin/posts/{id}/edit', 'AdminPostController@edit')->name('admin_posts_edit');

Route::post('admin/posts', 'AdminPostController@store')->name('admin_posts_store');

Route::put('admin/posts/update/{id}', 'AdminPostController@update')->name('admin_posts_update');

Route::get('postm/check_slug', 'AdminPostController@check_slug')->name('admin.post.check_slug');

Route::post('admin/activate/posts/{id}','AdminPostController@active')->name('admin_activate_post');

Route::post('admin/desactivate/posts/{id}','AdminPostController@desactive')->name('admin_desactivate_post');

//Admin Payment

Route::get('admin/payments', 'AdminPaymentController@index')->name('admin_payments');

Route::get('admin/payments/{id}', 'AdminPaymentController@show')->name('admin_payments_show');

//Admin Disease

Route::get('admin/diseases', 'AdminDiseaseController@index')->name('admin.diseases');

Route::get('admin/diseases/{id}', 'AdminDiseaseController@show')->name('admin_diseases_show');

Route::get('admin/create/diseases', 'AdminDiseaseController@create')->name('admin_diseases_create');

Route::delete('admin/diseases_delete/{id}', 'AdminDiseaseController@delete')->name('admin_diseases_delete');

Route::put('admin/posts/update/{id}', 'AdminPostController@update')->name('admin_posts_update');

Route::get('admin/diseases/{id}/edit', 'AdminDiseaseController@edit')->name('admin_diseases_edit');

Route::post('admin/diseases', 'AdminDiseaseController@store')->name('admin_diseases_store');

Route::get('diseasem/check_slug', 'AdminDiseaseController@check_slug')->name('admin.disease.check_slug');

//Admin Signature Approval

Route::get('admin/active/signatures', 'AdminSignatureController@index')->name('admin.signatures');

Route::get('admin/pending/signatures', 'AdminSignatureController@pending')->name('admin.pending_signatures');

Route::get('admin/signatures/{id}', 'AdminSignatureController@show')->name('admin_signatures_show');

Route::delete('admin/signatures_delete/{id}', 'AdminSignatureController@delete')->name('admin_signatures_delete');

Route::get('admin/create/signatures', 'AdminSignatureController@create')->name('admin_signatures_create');

Route::get('admin/signatures/{id}/edit', 'AdminSignatureController@edit')->name('admin_signatures_edit');

Route::post('admin/signatures', 'AdminSignatureController@store')->name('admin_signatures_store');

Route::put('admin/signatures/update/{id}', 'AdminSignatureController@update')->name('admin_signatures_update');

//Admin Appointment

Route::get('admin/appointments', 'AdminAppointmentController@index')->name('admin_appointments');

//Frontend Authentification

//Route::get('/login/doctor', 'Auth\LoginController@showDoctorLoginForm');

//Route::post('/login/doctor', 'Auth\LoginController@doctorLogin');

//2FA

/*Route::group(['prefix'=>'2fa'], function(){
   // Route::get('/','LoginSecurityController@show2faForm');
   Route::post('/generateSecret','LoginSecurityController@generate2faSecret')->name('generate2faSecret');
    Route::post('/enable2fa','LoginSecurityController@enable2fa')->name('enable2fa');
    Route::post('/disable2fa','LoginSecurityController@disable2fa')->name('disable2fa');

});*/

//Route::get('/get2fasetting','LoginSecurityController@get2fasetting')->name('get2fasetting');

/*Route::post('/2fa', function () {

    return redirect(URL()->previous());

})->name('2fa')->middleware('2fa');*/

Auth::routes();

//Route::get('/complete-registration', 'Auth\RegisterController@completeRegistration')->name('complete_registration');

//Route::get('/re-authenticate', 'LoginSecurityController@reauthenticate')->name('re_authenticate');

Route::get('/register/doctor', 'Auth\RegisterController@showDoctorRegisterForm')->name('register_doctor');

Route::post('/register/doctor', 'Auth\RegisterController@registerDoctor');

//Route::post('/register/doctor', 'Auth\RegisterController@createDoctor');

Route::get('/getDoctors', 'PagesController@getDoctors')->name('getDoctors');

Route::post('/take/{id}', ['as' => 'take', 'uses' => 'DoctorManagerController@take']);

Route::post('/finish/{id}', ['as' => 'finish', 'uses' => 'DoctorManagerController@finish']);

Route::post('/checkup', 'AppointmentController@check')->name('checkUp');

Route::post('/archivedapt', 'DoctorManagerController@archivedApt')->name('archivedapt');

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

Route::get('changeStatus', 'DoctorController@ChangeUserStatus')->name('changeStatus');

Route::resource('ratings', 'RatingController');

// Admin Medical Ressources

Route::resource('signatures', 'SignatureController');

Route::resource('specialities', 'SpecialityController');

Route::resource('services', 'ServiceController');

Route::resource('drugs', 'DrugController');

Route::resource('diseases', 'DiseaseController');

Route::resource('drugtypes', 'DrugTypeController');

Route::resource('prescriptions', 'PrescriptionController');

Route::resource('prescriptiontypes', 'PrescriptionTypeController');

//Admin Doctor

Route::resource('doctors', 'DoctorController');

Route::resource('patients', 'PatientController');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

Route::resource('categories', 'CategoryController');

Route::resource('schedules', 'ScheduleController');

Route::resource('appointments', 'AppointmentController');

Route::post('verif/{id}','PaymentController@verif')->name('verif');

//Patients Routes

Route::post('/patient/crop-image-upload', 'PatientManagerController@uploadCropImage')->name('patient_crop_image');

Route::get('/patient/profile_setting', 'PatientManagerController@setting')->name('patient_profile_setting');

Route::post('/patient/post_setting', 'PatientManagerController@postSetting')->name('post_patient_setting');

Route::get('/patient/profile/{id}', ['as' => 'patient.profile', 'uses' => 'PagesController@profilePatient']);

Route::get('/patient/booking/{id}', ['as' => 'booking.doctor', 'uses' => 'PatientManagerController@booking']);

Route::get('/patient/rating/{id}', ['as' => 'rating.doctor', 'uses' => 'PatientManagerController@rating']);

Route::get('/invoice/{id}', ['as' => 'invoice.show', 'uses' => 'PaymentController@show']);

Route::get('/patient/booking/success/{appointment}/{doctor}', ['as' => 'booking.success', 'uses' => 'AppointmentController@success']);

Route::get('/getSchedules', 'PatientManagerController@getSchedules')->name('getSchedules');

Route::get('/patient/change_password', 'PatientManagerController@changePassword')->name('patient_change_password');

Route::post('/patient/update_password', 'PatientManagerController@updatePassword')->name('patient_update_password');

Route::post('favorite/{doctor}', 'PatientManagerController@favoriteDoctor');

Route::post('unfavorite/{doctor}', 'PatientManagerController@unFavoriteDoctor');

Route::get('my_favourites', 'PatientManagerController@myFavorites')->name('my_favourites')->middleware('auth');

//Doctors Routes

Route::post('/doctor/crop-image-upload', 'DoctorManagerController@uploadCropImage')->name('doctor_crop_image');

Route::get('/doctor/profile_setting', 'DoctorManagerController@setting')->name('doctor_profile_setting');

Route::post('/doctor/post_setting', 'DoctorManagerController@postSetting')->name('post_doctor_setting');

Route::get('/doctor/profile/{id}', ['as' => 'doctor.profile', 'uses' => 'PagesController@profileDoctor']);

Route::get('/doctor/change_password', 'DoctorManagerController@changePassword')->name('doctor_change_password');

Route::post('/doctor/update_password', 'DoctorManagerController@updatePassword')->name('doctor_update_password');

Route::get('/doctor/my_appointments', 'DoctorManagerController@myAppointments')->name('doctor_my_appointments');

Route::get('/doctor/my_patients', 'DoctorManagerController@myPatients')->name('doctor_my_patients');

Route::get('/doctor/reviews', 'DoctorManagerController@reviews')->name('doctor_reviews');

Route::get('/doctor/my_invoices', 'DoctorManagerController@myInvoices')->name('doctor_my_invoices');

Route::get('/doctor/pending_posts', 'PostController@pending')->name('doctor_pending_posts');

Route::get('/doctor/startapt/{id}', ['as' => 'appointment.start', 'uses' => 'DoctorManagerController@start']);

Route::post('/bulk/schedules/store', 'ScheduleController@save')->name('bulk_schedules_store');

Route::post('/bulk/schedules/update', 'ScheduleController@modif')->name('bulk_schedules_update');

Route::post('/post/reviews/answers', 'RatingController@saveAnswer')->name('review_answers_store');

Route::post('/post/answers/replies', 'RatingController@replyStore')->name('answers_replies_store');
//Website Pages

Route::get('/', 'PagesController@index')->name('home');

Route::get('/about-us', 'PagesController@about')->name('about');

Route::get('/our-services', 'PagesController@services')->name('services');

Route::get('/contact-us', 'PagesController@contact')->name('contact');

Route::post('contact', 'ContactController@store')->name('postcontact');

Route::get('/search', 'SearchController@search')->name('search');

Route::get('/get/services', 'PagesController@search')->name('get_services');

Route::post('/search', 'SearchController@postSearch')->name('search');

Route::get('/search/disease', 'SearchController@searchDisease')->name('search_disease');

Route::post('/postsearch/disease', 'SearchController@postData')->name('post_search_disease');

Route::get('/blog', 'PagesController@blog')->name('blog');

Route::get('/our-doctors', 'PagesController@doctors')->name('our_doctors');

Route::get('list/doctors', 'PagesController@listDoctor')->name('list_doctors');

Route::get('/terms', 'PagesController@terms')->name('terms');

Route::get('/policy', 'PagesController@policy')->name('policy');

Route::get('/faq', 'PagesController@faq')->name('faq');

Route::get('/getCountries', 'PagesController@getCountries')->name('getCountries');

Route::post('/loadmore/load_data', 'PagesController@load_data')->name('loadmore.load_data');

Route::get('post/{slug}', ['as' => 'blog.show', 'uses' => 'PagesController@postDetails']);

Route::get('category/{slug}', ['as' => 'categoryPosts', 'uses' => 'PagesController@categoryPosts']);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('doctor/dashboard', 'DoctorManagerController@index')->name('doctor_dashboard');

Route::get('categorie/check_slug', 'CategoryController@check_slug')->name('category.check_slug');

Route::get('postn/check_slug', 'PostController@check_slug')->name('post.check_slug');

Route::get('diseasen/check_slug', 'DiseaseController@check_slug')->name('disease.check_slug');

//Chat

//Route::get('/chat', 'ChatController@index')->name('chat');

Route::get('/messages', 'ChatController@fetchAllMessages');

Route::post('/messages', 'ChatController@sendMessage');

//Messages

Route::get('/load-latest-messages', 'MessagesController@getLoadLatestMessages');
 
Route::post('/send', 'MessagesController@postSendMessage');

Route::get('/fetch-old-messages', 'MessagesController@getOldMessages');

//Localisation

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
});

//Video Chat

//Route::get('/home', 'HomeController@index')->name('home');

/*Route::get('/chat/{id}', 'VideoChatController@chat')->name('videochat');

Route::get('/group/chat/{id}', 'VideoChatController@groupChat')->name('group.chat');

Route::post('/chat/message/send', 'VideoChatController@send')->name('chat.send');

Route::post('/chat/message/send/file', 'VideoChatController@sendFilesInConversation')->name('chat.send.file');

Route::post('/group/chat/message/send', 'VideoChatController@groupSend')->name('group.send');

Route::post('/group/chat/message/send/file', 'VideoChatController@sendFilesInGroupConversation')->name('group.send.file');

*/

/*Route::group(['prefix' => 'admin'], function() {

  
Route::get('events/{event}/remind/{user}', [
'as' => 'remindHelper', 'uses' => 'EventsController@remindHelper']);
View:

route('remindHelper',['event'=>$eventId,'user'=>$userId]);
    
});*/

/*Route::get('/test', function () {

    $date = Carbon::today()->toDateString();

    $timestamp = strtotime($date);

    $month = date('m', $timestamp);

    $name = Str::of('KOSSIGAN')->substr(0,3)->upper();

    $firstname = Str::of('Prodige')->substr(0,1)->upper();

    $matricule = 'TG'.date("y").$month.$name.$firstname;

    dd($matricule);
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