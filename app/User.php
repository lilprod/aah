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
        'name', 'email', 'password','firstname','phone_number','username', 'address', 'profile_picture','role_id', 'firebase_token','lang', 'is_activated','provider', 'provider_id'
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
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages(){

        return $this->hasMany(Message::class);
        
    }

    public function favorites()
    {
        return $this->belongsToMany(Doctor::class, 'favourites', 'user_id', 'doctor_id')->withTimeStamps();
    }

    public function allChatMsg()
    {
        return Message::where('to_id', $this->id)->where('seen', 0)->count();
    }

    public function patientappointments()
    {
        return Appointment::where('patient_user_id', $this->id)
                            ->orderBy('id', 'DESC')
                            ->get();
    }

    public function doctorUpcomingapts()
    {
        $date = Carbon::now()->toDateString();

        return Appointment::where('doctor_user_id', $this->id)
                            //->whereNotIn('status', array(2))
                            ->where('date_apt', '>' , $date)
                            ->get();
    }

    public function doctorTodayapts()
    {
        $date = Carbon::now()->toDateString();

        return Appointment::where('doctor_user_id', $this->id)
                            ->where('status' ,'=', 1)
                            ->where('date_apt', '=' , $date)
                            ->get();
    }

    public function doctorPendingapts()
    {
        $date = Carbon::now()->toDateString();

        return Appointment::where('doctor_user_id', $this->id)
                            ->where('status' ,'=', 0)
                            ->where('date_apt', '>' , $date)
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
