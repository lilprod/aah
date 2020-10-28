<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Patient;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminReviewController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth:admin']); //supAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews  = DB::table('ratings')->get();

        foreach ($reviews as $review) {
        	# code...
        	$patient = Patient::where('user_id',$review->author_id)->first();

        	$doctor = Doctor::findOrFail($review->rateable_id);

        	$review->patient_name = $patient->name;
        	$review->patient_firstname = $patient->firstname;
        	$review->patient_image = $patient->profile_picture;
        	$review->doctor_name = $doctor->name;
        	$review->doctor_firstname = $doctor->firstname;
        	$review->doctor_image = $doctor->profile_picture;
        	$review->created_at = Carbon::parse($review->created_at);
        }

        return view('admin.reviews.index')->with('reviews', $reviews);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('ratings')->where('id', $id)
        					->delete();
        //DB::table('ratings')->delete($id);

        return redirect()->route('admin.reviews')
            ->with('success',
             'Review deleted successfully.');
    }
}
