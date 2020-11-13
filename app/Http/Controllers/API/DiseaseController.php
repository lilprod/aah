<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\Disease as DiseaseResource;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Disease;
use App\User;
use App\History;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiseaseController extends BaseController
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function postSearch(Request $request)
    {
        $params = $request->except('_token');

        //$diseases = Disease::filter($params)->get();

        $diseases = Disease::filter($params)->orderByDesc('id')->paginate(10);;

        if (count($diseases) > 0){

            foreach ($diseases as $disease) {
                # code...

               $disease['cover_image'] = $_ENV['APP_URL'].'/storage/diseases/'.$disease->cover_image;

               $disease['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.$disease->user->profile_picture;

               $disease->author = $disease->user->name;

               //$disease ->author = $user->name.' '.$user->firstname;
            }


            return $this->sendResponse($diseases, 'Diseases retrieved successfully.');

        }

        return $this->sendResponse([], 'No Disease found for your query. Try to search again!');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diseases = Disease::where('status', 1)
                            ->get();

        foreach ($diseases as $disease) {
            # code...

           $disease['cover_image'] = $_ENV['APP_URL'].'/storage/diseases/'.$disease->cover_image;

           $disease['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.$disease->user->profile_picture;

           $disease->author = $disease->user->name;

           //$disease ->author = $user->name.' '.$user->firstname;
        }

        return $this->sendResponse($diseases, 'Diseases retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mydiseases()
    {
        $user_id = Auth::guard('api')->user()->id;

        $diseases = Disease::where('user_id', $user_id)
                            ->get();

        foreach ($diseases as $disease) {
            # code...
           //$user = User::findOrFail($post->user_id);
            
           $disease['cover_image'] = $_ENV['APP_URL'].'/storage/diseases/'.$disease->cover_image;

           $disease['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.$disease->user->profile_picture;

           $disease->author = $disease->user->name;

           //$post->author = $user->name.' '.$user->firstname;
        }
        return $this->sendResponse($diseases, 'Diseases retrieved successfully.');
    }

    public function upload(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'cover_image' =>'image|nullable',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if ($request->hasfile('cover_image')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //$extension = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/diseases', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        return $this->sendResponse($fileNameToStore, 'Disease Image saved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function check_slug(Request $request)
    {
        // New version: to generate unique slugs
        $slug = SlugService::createSlug(Disease::class, 'slug', $request->title);

        return $this->sendResponse($slug, 'Slug of Title.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'title' => 'required|max:120',
            'scientific_name' => 'nullable',
            'slug'  => 'required|min:3|max:255|unique:diseases',
            'description' => 'nullable',
            'treatment' => 'required',
            //'attach_file' => 'nullable',
            'video_url' => 'nullable',
            'cover_image' =>'nullable',
            'status' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $disease = new Disease();
        $disease->title = $request->input('title');
        $disease->scientific_name = $request->input('scientific_name');
        $disease->description = $request->input('description');
        $disease->video_url = $request->input('video_url');
        $disease->treatment = $request->input('treatment');

        if(!empty($request->input('cover_image'))){

            $disease->cover_image = $request->input('cover_image');
        }else{

            $disease->cover_image = 'noimage.jpg';
        }

        // Get current user
        //$userId = Auth::guard('api')->user()->id;
        //$user = User::findOrFail($userId);

        $disease->status = $request->input('status');
        $disease->user_id = Auth::guard('api')->user()->id;
        //$disease->attach_file = $request->input('attach_file');
        //$disease->meta_keywords = $request->input('meta_keywords');
        //$disease->meta_description = $request->input('meta_description');
        //$disease->username = auth()->user()->name.' '.auth()->user()->firstname;

        /*$historique = new History();
        $historique->action = 'Create';
        $historique->table = 'Disease';
        $historique->user_id = auth()->user()->id;*/

        $disease->save();

        $disease['cover_image'] = $_ENV['APP_URL'].'/storage/diseases/'.$disease->cover_image;

        $disease['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.$disease->user->profile_picture;

        $disease['author']= $disease->user->name;

        return $this->sendResponse($disease, 'Disease created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disease = Disease::find($id);
  
        if (is_null($disease)) {
            return $this->sendError('Disease not found.');
        }

        $disease['cover_image'] = $_ENV['APP_URL'].'/storage/diseases/'.$disease->cover_image;

        $disease['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.$disease->user->profile_picture;

        $disease['author']= $disease->user->name;

        return $this->sendResponse($disease, 'Disease retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'title' => 'required|max:120',
            'scientific_name' => 'nullable',
            'slug'  => 'required|min:3|max:255|unique:diseases,id,' . $disease->slug, 
            'description' => 'nullable',
            'treatment' => 'required',
            //'attach_file' => 'nullable',
            'video_url' => 'nullable',
            'cover_image' =>'nullable',
            'status' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $disease->title = $request->input('title');
        $disease->scientific_name = $request->input('scientific_name');
        $disease->description = $request->input('description');
        $disease->treatment = $request->input('treatment');
        if(!empty($request->input('cover_image'))){

            $disease->cover_image = $request->input('cover_image');
        }
        $disease->video_url = $request->input('video_url');
        $disease->status = $request->input('status');
        $disease->user_id = Auth::guard('api')->user()->id;
        //$disease->user_id = auth()->user()->id;
        //$disease->attach_file = $request->input('attach_file');
        //$disease->meta_keywords = $request->input('meta_keywords');
        //$disease->meta_description = $request->input('meta_description');
        //$disease->username = auth()->user()->name.' '.auth()->user()->firstname;
        $disease->save();
        /*$historique = new History();
        $historique->action = 'Create';
        $historique->table = 'Disease';
        $historique->user_id = auth()->user()->id;*/

        $disease['cover_image'] = $_ENV['APP_URL'].'/storage/diseases/'.$disease->cover_image;

        $disease['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.$disease->user->profile_picture;

        $disease->author = $disease->user->name;

        return $this->sendResponse($disease, 'Disease updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease)
    {
        if ($disease->cover_image != 'noimage.jpg') {
            Storage::delete('public/diseases/'.$post->cover_image);
        }

        $disease->delete();
   
        return $this->sendResponse([], 'Disease deleted successfully.');
    }
}
