<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Post;
use Validator;

class PostController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        $posts = Post::where('status', 1)->get();

        return $this->sendResponse($posts, 'Posts retrieved successfully.');

        //return $this->sendResponse(PostResource::collection($posts), 'Posts retrieved successfully.');
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
            'slug'  => 'required|min:3|max:255|unique:posts',
            'description' => 'nullable',
            'body' => 'required',
            'attach_file' => 'nullable',
            'video_url' => 'nullable',
            'cover_image' =>'image|nullable',
            'status' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $post = Post::create($input);
   
        return $this->sendResponse(new PostResource($post), 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
  
        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }
   
        return $this->sendResponse(new PostResource($post), 'Post retrieved successfully.');
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
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($input, [
            'title' => 'required|max:120',
            'slug'  => 'required|min:3|max:255|unique:posts',
            'description' => 'nullable',
            'body' => 'required',
            'attach_file' => 'nullable',
            'video_url' => 'nullable',
            'cover_image' =>'image|nullable',
            'status' => 'required',
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

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->body = $request->input('body');

        if ($request->hasfile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }

        $post->status = $request->input('status');
        $post->user_id = auth()->user()->id;
        //$post->attach_file = $request->input('attach_file');
        $post->video_url = $request->input('video_url');

        if($request->input('category_id') == ' '){

            $post->category_id = 1;

        }else{

            $post->category_id = $request->input('category_id');
        }
        // your previous code

        //$post->meta_keywords = $request->input('meta_keywords');
        //$post->meta_description = $request->input('meta_description');
  
        $post->save();

        return $this->sendResponse($post, 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->cover_image != 'noimage.jpg') {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
   
        return $this->sendResponse([], 'Post deleted successfully.');
    }
}
