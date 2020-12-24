<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\User;
use App\Post;
use App\Category;
use App\Speciality;
use App\Patient;
use App\History;
use App\Appointment;
use App\Prescription;
use App\Payment;
use App\PrescribedDrug;
use App\PrescriptionExam;
use App\Schedule;
use Carbon\Carbon;
use App\Country;
use App\Review;
use App\Answer;
use App\Service;

class PagesController extends Controller
{

  public function search(Request $request)
  {
        // check if ajax request is coming or not
        if($request->ajax()) {

            // select service title from database
            $data = Service::where('title', 'LIKE', $request->title.'%')
                            ->get();
            
            // declare an empty array for output
            $output = '';
            
            // if searched countries count is larager than zero
            if (count($data)>0) {
                // concatenate output to the array
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                // loop through the result array
                foreach ($data as $row){
                    // concatenate output to the array
                    $output .= '<li class="list-group-item">'.$row->title.'</li>';
                }
                // end of output
                $output .= '</ul>';
            }
            else {
                // if there's no matching results according to the input
                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
            // return output result array
            return $output;
        }
    }


    public function index()
    {
        $specialities = Speciality::all();

        $posts = Post::with('category')
                        ->where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->paginate(3);

        foreach ($posts as $post) {
            # code...
           $user = User::findOrFail($post->user_id);

           $post->author_image = $user->profile_picture;

           $post->author = $user->name;

           //$post->author = $user->name.' '.$user->firstname;
        }

        return view('pages.index',compact('specialities','posts'));
    }

    public function getCountries(Request $request)
    {
        $contries = Country::where('region_id', $request->id)
                            ->get();
        return response()->json($contries);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profileDoctor($id){

        $doctor = Doctor::findOrFail($id);

        $reviews = $doctor->reviews;

        $specialities = Speciality::all();

        $services = $doctor->services;

        $date = Carbon::today();

        return view('doctors.profile', compact('doctor', 'reviews', 'specialities', 'services', 'date'));
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profilePatient($id) {

        $patient = Patient::findOrFail($id);

        $prescriptions = Prescription::orderBy('created_at', 'desc')
                            ->where('patient_id', $id)
                            ->get();

        $payments = Payment::orderBy('created_at', 'desc')
                            ->where('patient_id', $id)
                            ->get();

        $bookings = Appointment::orderBy('created_at', 'desc')
                            ->where('patient_id', $id)
                            ->get();

        $lastbookings = Appointment::orderBy('created_at', 'desc')
                            ->where('patient_id', $id)
                            ->limit(2)
                            ->get();
        
        return view('patients.patient_profile', compact('patient', 'lastbookings', 'bookings', 'prescriptions', 'payments'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function doctors()
    {
        $doctors = Doctor::where('status', 1)
                          ->get();

        return view('pages.doctors',compact('doctors'));
    }


    public function listDoctor()
    {
        $doctors = Doctor::where('status', 1)
                          ->get();

        return view('pages.list_doctors',compact('doctors'));
    }

    function load_data(Request $request)
    {
     if($request->ajax())
     {
      if($request->id > 0)
      {
       $data = DB::table('doctors')
          ->where('id', '<', $request->id)
          ->orderBy('id', 'DESC')
          ->limit(5)
          ->get();
      }
      else
      {
       $data = DB::table('doctors')
          ->orderBy('id', 'DESC')
          ->limit(5)
          ->get();
      }
      $output = '';
      $last_id = '';
      
      if(!$data->isEmpty())
      {
       foreach($data as $row)
       {
        $output .= '
        <div class="row">
         <div class="col-md-12">
          <h3 class="text-info"><b>'.$row->post_title.'</b></h3>
          <p>'.$row->post_description.'</p>
          <br />
          <div class="col-md-6">
           <p><b>Publish Date - '.$row->date.'</b></p>
          </div>
          <div class="col-md-6" align="right">
           <p><b><i>By - '.$row->author.'</i></b></p>
          </div>
          <br />
          <hr />
         </div>         
        </div>
        ';
        $last_id = $row->id;
       }
       $output .= '
       <div class="load-more text-center" id="load_more">
            <a class="btn btn-primary btn-sm" name="load_more_button" href="javascript:void(0);" data-id="'.$last_id.'" id="load_more_button">Load More</a>  
        </div>
       ';
      }
      else
      {
       $output .= '
       <div class="load-more text-center" id="load_more">
            <a class="btn btn-info btn-sm"  name="load_more_button" href="javascript:void(0);">No Data Found</a>  
        </div>
       ';
      }
      echo $output;
     }
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function policy()
    {
        return view('pages.policy');
    }

    public function blog()
    {
        //$posts = Post::all();

        //$posts = Post::orderBy('created_at', 'desc')->paginate(4);
        $categories = Category::all();

        $latestposts = Post::orderBy('created_at', 'desc')
                            ->where('status', 1)
                            ->limit(3)
                            ->get();

        $posts = Post::with('category')
                         ->where('status', 1)
                         ->orderBy('created_at', 'desc')
                         ->paginate(20);

        foreach ($posts as $post) {
            # code...
           $user = User::findOrFail($post->user_id);

           $post->author_image = $user->profile_picture;

           $post->author = $user->name;

           //$post->author = $user->name.' '.$user->firstname;
        }


        return view('pages.blog',compact('posts', 'categories', 'latestposts'));

        //return view('pages.blog')->with('posts', $posts);
    }

    public function postDetails($slug){

        $categories = Category::all();

        $latestposts = Post::orderBy('created_at', 'desc')
                            ->where('status', 1)
                            ->limit(3)
                            ->get();

        $post = Post::with('category')->where('slug',$slug)->first();

        $user = User::findOrFail($post->user_id);

        $post->author_image = $user->profile_picture;

        $post->author = $user->name;

        return view('pages.blog_detail',compact('post', 'categories', 'latestposts'));
    }

    /*public function posts(){
        $data = Post::with('category')->paginate(20);

        return view('site.posts',compact('data'));
    }*/

    public function categoryPosts($slug){

        $categories = Category::all();

        $latestposts = Post::orderBy('created_at', 'desc')
                            ->limit(3)
                            ->get();

        $data = Category::with('posts')->where('slug',$slug)->first();

        foreach ($data->posts as $post) {
            # code...
           $user = User::findOrFail($post->user_id);

           $post->author_image = $user->profile_picture;

           $post->author = $user->name;

           //$post->author = $user->name.' '.$user->firstname;
        }

        return view('pages.category_posts',compact('data', 'categories', 'latestposts'));
    }

    


    /*public function blogDetail()
    {
        //$post = Post::where('slug', $slug)->first();

        //return view('pages.blog_single',compact('property'));

        return view('pages.blog_single');
    }*/

    /*public function blogDetail($slug)
    {
        //$post = Post::where('slug', $slug)->first();

        //return view('pages.blog_single',compact('property'));

        return view('pages.blog_single');
    }*/

    public function contact()
    {
        return view('pages.contact');
    }

    public function services()
    {
        return view('pages.services');
    }

}




    

