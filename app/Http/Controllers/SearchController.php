<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

use App\Doctor;
use App\Disease;
use App\Speciality;

class SearchController extends Controller
{
    public function search()
    {
    	$specialities = Speciality::all();

        return view('pages.search', compact('specialities'));
    }

    public function postSearch(Request $request)
    {

    	$nb = 0;
    	
    	$specialities = Speciality::all();
        
        $params = $request->except('_token');

        //$doctors = Doctor::filter($params)->get();

        $doctors = Doctor::filter($params)->orderByDesc('id')->paginate(10,['*'],'page');

        $nb = count($doctors);

        if (count($doctors) > 0){

        	return view('pages.answers', compact('doctors', 'nb','specialities'));

		}

        return view('pages.answers', compact('nb', 'specialities'))->with('error', 'No Doctor found for your query. Try to search again!');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function searchDisease(){

        return view('pages.searchDisease');
    }

    public function postData(Request $request){

       $params = $request->except('_token'); 

       //$diseases = Disease::filter($params)->get();

        $diseases = Disease::filter($params)->orderByDesc('id')->paginate(10,['*'],'page');

        $nb = count($diseases);

        if (count($diseases) > 0){

            return view('pages.answersDisease', compact('diseases', 'nb'));

        }

        return view('pages.answersDisease', compact('nb'))->with('error', 'No Disease found for your query. Try to search again!');
    }

    /*public function postSearch()
    {

    	$q = Input::get('q');

	    if($q != "")
	    {
	    	$doctor = Doctor::where ( 'name', 'LIKE', '%' . $q . '%' )->orWhere('email', 'LIKE', '%'.$q.'%')->paginate (5)->setPath ('');
	    	$pagination = $doctor->appends ( array (
	                'q' => Input::get ('q') 
	        ) );


		    if (count ( $doctor ) > 0){

		        return view ('pages.search')->withDetails ($doctor)->withQuery($q);
		    }
		}
	    
	        return view ('pages.search')->withMessage ( 'No Details found. Try to search again !' );

        //return view('pages.search');
    }*/
}
