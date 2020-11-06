<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\User;

class BlogController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
        $posts = Post::with('category')
                       ->where('status', 1)
                       ->orderBy('created_at', 'desc')
                       ->paginate(20);

        foreach ($posts as $post) {
            # code...
           $user = User::findOrFail($post->user_id);

           $post['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$post->cover_image;

           $post['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;

           $post['author']= $user->name;

           //$post->author = $user->name.' '.$user->firstname;
        }

        return $this->sendResponse($posts, 'Posts retrieved successfully.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function latestposts()
    {
    	 $posts = Post::orderBy('created_at', 'desc')
                            ->where('status', 1)
                            ->limit(3)
                            ->get();

      foreach ($posts as $post) {
              # code...
             $user = User::findOrFail($post->user_id);

             $post['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$post->cover_image;

             $post['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;

             $post['author']= $user->name;

             //$post->author = $user->name.' '.$user->firstname;
        }

        return $this->sendResponse($posts, 'Latest Posts retrieved successfully.');
    }


    public function postDetails($slug)
    {
        $post = Post::with('category')->where('slug', $slug)->first();

        $user = User::findOrFail($post->user_id);

        $post['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;

        $post['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$post->cover_image;

        $post['author']= $user->name;

        return $this->sendResponse($post, 'Post retrieved successfully.');
    }


    public function categoryPosts($slug){

        $data = Category::with('posts')->where('slug',$slug)->first();

        foreach ($data->posts as $post) {
            # code...
           $user = User::findOrFail($post->user_id);

           $post['author_image'] = $_ENV['APP_URL'].'/storage/profile_images/'.$user->profile_picture;

           $post['cover_image'] = $_ENV['APP_URL'].'/storage/cover_images/'.$post->cover_image;

           $post['author']= $user->name;

           //$post->author = $user->name.' '.$user->firstname;
        }

        return $this->sendResponse($data, 'Post retrieved successfully.');
    }
}
