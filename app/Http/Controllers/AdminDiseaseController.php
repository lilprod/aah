<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use App\Disease;
use App\User;
use App\Admin;
use App\History;

class AdminDiseaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $diseases = Disease::all();

        foreach ($diseases as $disease) {
            # code...
           //$user = User::findOrFail($post->user_id);

           $disease->author_image = $disease->user->profile_picture;

           $disease->author = $disease->user->name;

           //$post->author = $user->name.' '.$user->firstname;
        }

         return view('admin.diseases.index')->with('diseases', $diseases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.diseases.create');
    }

    public function check_slug(Request $request)
    {
        // New version: to generate unique slugs
        $slug = SlugService::createSlug(Disease::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'scientific_name' => 'nullable',
            'slug'  => 'required|min:3|max:255|unique:diseases',
            'description' => 'nullable',
            'treatment' => 'required',
            //'attach_file' => 'nullable',
            'video_url' => 'nullable',
            'cover_image' =>'image|nullable',
            'status' => 'required',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        if ($request->hasfile('cover_image')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/diseases', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $disease = new Disease();
        $disease->title = $request->input('title');
        $disease->scientific_name = $request->input('scientific_name');
        $disease->description = $request->input('description');
        //$disease->slug = $request->input('slug');
        $disease->video_url = $request->input('video_url');
        $disease->treatment = $request->input('treatment');
        $disease->cover_image = $fileNameToStore;
        $disease->status = $request->input('status');

        $admin = Admin::findOrFail(auth()->user()->id);
        $disease->user_id = $admin->user_id;

        //$disease->user_id = auth()->user()->id;
        //$disease->attach_file = $request->input('attach_file');
        //$disease->meta_keywords = $request->input('meta_keywords');
        //$disease->meta_description = $request->input('meta_description');
        //$disease->username = auth()->user()->name.' '.auth()->user()->firstname;

        /*$historique = new History();
        $historique->action = 'Create';
        $historique->table = 'Disease';
        $historique->user_id = auth()->user()->id;*/

        $disease->save();

       //$historique->save();
        return redirect()->route('admin.diseases')->with('success', 'Disease recorded successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disease = Disease::findOrFail($id);

        return view('admin.diseases.show', compact('disease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disease = Disease::findOrFail($id);

        return view('admin.diseases.edit', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $disease = Disease::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|max:120',
            'scientific_name' => 'nullable',
            'slug'  => 'required|min:3|max:255|unique:posts,id,' . $disease->slug,
            'description' => 'nullable',
            'treatment' => 'required',
            //'attach_file' => 'nullable',
            'video_url' => 'nullable',
            'cover_image' =>'image|nullable',
            'status' => 'required',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        if ($request->hasfile('cover_image')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/diseases', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        
        $disease->title = $request->input('title');
        $disease->scientific_name = $request->input('scientific_name');
        $disease->description = $request->input('description');
        $disease->video_url = $request->input('video_url');
        //$disease->slug = $request->input('slug');
        $disease->treatment = $request->input('treatment');
        if ($request->hasfile('cover_image')) {
            $disease->cover_image = $fileNameToStore;
        }
        $disease->status = $request->input('status');

        //$disease->attach_file = $request->input('attach_file');
        //$disease->meta_keywords = $request->input('meta_keywords');
        //$disease->meta_description = $request->input('meta_description');
        //$disease->username = auth()->user()->name.' '.auth()->user()->firstname;

        /*$historique = new History();
        $historique->action = 'Update';
        $historique->table = 'Disease';
        $historique->user_id = auth()->user()->id;*/

        $disease->save();

       //$historique->save();
        return redirect()->route('admin.diseases')->with('success', 'Disease updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find a post with a given id and delete
        $disease = Disease::findOrFail($id);
  
        if ($disease->cover_image != 'noimage.jpg') {
            Storage::delete('public/diseases/'.$disease->cover_image);
        }

        $disease->delete();

        return redirect()->route('admin.diseases')->with('success', 'Disease deleted successfully.');
    }
}
