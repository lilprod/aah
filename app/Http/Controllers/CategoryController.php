<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

use App\Category;

class CategoryController extends Controller
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
        $categories = Category::all(); //Get all categories

        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    public function check_slug(Request $request)
    {
        // Old version: without uniqueness
        //$slug = str_slug($request->title);

        // New version: to generate unique slugs
        $slug = SlugService::createSlug(Category::class, 'slug', $request->title);

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
            'slug'  => 'required|min:3|max:255|unique:categories',
            'description' => 'nullable',
            ],

            $messages = [
                'required' => 'The :attribute field is required.',
            ]
        );

        $category = new Category(); //Get category specified by id

        $category->title = $request->input('title');
        $category->description = $request->input('description');

        $category->save();

        return redirect()->route('categories.index')
            ->with('success',
             'Category added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        
        return view('admin.categories.edit', compact('category'));
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
        $category = Category::findOrFail($id); //Get speciality specified by id

        //Validate name, email and password fields
        $this->validate($request, [
            'title' => 'required|max:120',
            'slug'  => 'required|min:3|max:255|unique:categories,id,' . $category->slug,
            'description' => 'nullable',
        ]);

        $category->title = $request->input('title');
        $category->description = $request->input('description');
       

        $category->save();

        return redirect()->route('categories.index')
            ->with('success',
             'Category updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find a user with a given id and delete
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success',
             'Category deleted successfully.');
    }
}
