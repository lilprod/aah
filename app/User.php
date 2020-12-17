<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use App\Message;
use App\Appointment;
use App\Schedule;
use Carbon\Carbon;
use App\Post;
use App\Prescription;
use App\Payment;
//use App\Alert;
use App\Notification;
use AgilePixels\Rateable\Traits\AddsRating;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasRoles,Notifiable,HasApiTokens, AddsRating;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','google2fa_secret', 'google2fa_enable','firstname','phone_number','username', 'address', 'profile_picture','role_id', 'firebase_token','lang', 'is_activated','provider', 'provider_id'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'google2fa_secret',
    ];


    /**
     * Ecrypt the user's google_2fa secret.
     *
     * @param  string  $value
     * @return string
     */
    public function setGoogle2faSecretAttribute($value)
    {
         $this->attributes['google2fa_secret'] = encrypt($value);
    }

    /**
     * Decrypt the user's google_2fa secret.
     *
     * @param  string  $value
     * @return string
     */
    public function getGoogle2faSecretAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reviews() 
    {
        return $this->hasMany(Review::class);
    }

    public function mynotifications()
    {
        return Notification::where('receiver_id', $this->id)
                            ->where('status', 0)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function myunreadnotifications()
    {
        return Notification::where('receiver_id', $this->id)
                            ->where('status', 1)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function signature()
    {
        return $this->hasOne('App\Signature');
    }

    public function messages(){

        return $this->hasMany(Message::class);
        
    }

    public function patient()
    {
        return Patient::where('user_id', $this->id)
                            ->first();
    }

    public function doctor()
    {
        return Doctor::where('user_id', $this->id)
                            ->first();
    }

    public function posts(){

        return $this->hasMany(Post::class);
        
    }

    public function diseases(){

        return $this->hasMany(Disease::class);
        
    }

    public function favorites()
    {
        return $this->belongsToMany(Doctor::class, 'favourites', 'user_id', 'doctor_id')->withTimeStamps();
    }

    public function allChatMsg()
    {
        return Message::where('to_id', $this->id)->where('seen', 0)->count();
    }

    public function patientprescriptions(){

        return Prescription::where('patient_userid', $this->id)
                            ->orderBy('id', 'DESC')
                            ->get();

    }

    public function patientpayments(){

        return Payment::where('patient_user_id', $this->id)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function doctorpayments(){
         return Payment::where('doctor_user_id', $this->id)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function doctorprescriptions(){

        return Prescription::where('doctor_userid', $this->id)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function patientappointments()
    {
        return Appointment::where('patient_user_id', $this->id)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function patientArchivedapts()
    {
        $date = Carbon::now()->toDateString();

        return Appointment::where('patient_user_id', $this->id)
                            ->where('date_apt', '<' , $date)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function patientUpcomingapts()
    {
        $date = Carbon::now()->toDateString();

        return Appointment::where('patient_user_id', $this->id)
                            ->where('status' ,'=', 1)
                            ->where('date_apt', '>' , $date)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function patientPendingapts()
    {
        $date = Carbon::now()->toDateString();

        return Appointment::where('patient_user_id', $this->id)
                            ->where('status' ,'=', 0)
                            ->where('date_apt', '>' , $date)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function doctorArchivedapts()
    {
        $date = Carbon::now()->toDateString();

        return Appointment::where('doctor_user_id', $this->id)
                            ->where('date_apt', '<' , $date)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function doctorUpcomingapts()
    {
        $date = Carbon::now()->toDateString();

        return Appointment::where('doctor_user_id', $this->id)
                            ->where('status' ,'=', 1)
                            ->where('date_apt', '>' , $date)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function doctorTodayapts()
    {
        $date = Carbon::now()->toDateString();

        return Appointment::where('doctor_user_id', $this->id)
                            ->where('status' ,'=', 1)
                            ->where('date_apt', '=' , $date)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function doctorPendingapts()
    {
        $date = Carbon::now()->toDateString();

        return Appointment::where('doctor_user_id', $this->id)
                            ->where('status' ,'=', 0)
                            ->where('date_apt', '>' , $date)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function myschedules()
    {
        return Schedule::where('doctor_userid', $this->id)
                            ->get();

    }

    public function myMondayschedules()
    {
        return Schedule::where('day_num', 1)
                        ->where('doctor_userid', $this->id)
                        ->get();
    }

    public function myTuesdayschedules()
    {
        return Schedule::where('day_num', 2)
                        ->where('doctor_userid',$this->id)
                        ->get();
    }

    public function myWednesdayschedules()
    {
        return Schedule::where('day_num', 3)
                        ->where('doctor_userid', $this->id)
                        ->get();
    }

    public function myThursdayschedules()
    {
        return Schedule::where('day_num', 4)
                        ->where('doctor_userid', auth()->user()->id)
                        ->get();
    }

    public function myFridayschedules()
    {
        return Schedule::where('day_num', 5)
                        ->where('doctor_userid', auth()->user()->id)
                        ->get();
    }  
                      
    public function mySaturdayschedules()
    {
        return Schedule::where('day_num', 6)
                        ->where('doctor_userid', auth()->user()->id)
                        ->get();
    }

    public function mySundayschedules()
    {
        return Schedule::where('day_num', 7)
                        ->where('doctor_userid', auth()->user()->id)
                        ->get();
    }

    public function myposts()
    {
        return Post::where('user_id', $this->id)
                            ->get();

    }

    public function mydraftsposts()
    {
        return Post::where('user_id', $this->id)
                            ->where('status', '=' , 0)
                            ->get();
    }


    public function myactivatedposts()
    {
        return Post::where('user_id', $this->id)
                            ->where('status', '=' , 1)
                            ->get();

    }

    public function myallapts()
    {

        $date = Carbon::now()->toDateString();
        return Appointment::where('doctor_user_id', $this->id)
                            ->where('date_apt', '>=' , $date)
                            ->get();

    }

    public function userAverageRating($doctor)
    {
        //return $this->hasMany(Rating::class);
       return DB::table('ratings')->where('author_id', $this->id)
                                  ->where('rateable_id', $doctor)
                                  ->pluck('rating')->avg();
    }

}
