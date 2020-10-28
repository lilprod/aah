<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Admin;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;

//Enables us to output flash messaging

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth', 'isAdmin']); //supAdmin middleware lets only users with a //specific permission permission to access these resources
        $this->middleware(['auth:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all users and pass it to the view
        //$users = User::all();
        $users = User::Where('role_id', 3)->get();
        //$users = Admin::all();

        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get all roles and pass it to the view
        //$roles = Role::get();
        //Role::whereNotIn('id', array(1, 7, 21))->get();
        $roles = Role::whereNotIn('id', array(3,2))->get();
        //dd($roles);

        return view('admin.users.create', ['roles' => $roles]);
        //return view('users.create', compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate name, email and password fields
        $this->validate($request, [
            'name' => 'required|max:120',
            'firstname' => 'required|max:120',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'required',
            'address' => 'required',
            'profile_picture' => 'image|nullable',
        ]);

        if ($request->hasfile('profile_picture')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('profile_picture')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('profile_picture')->storeAs('public/profile_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'avatar.jpg';
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->firstname = $request->input('firstname');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->profile_picture = $fileNameToStore;
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        $user->role_id = 3;
        $user->is_activated = 1;


        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->firstname = $request->input('firstname');
        $admin->email = $request->input('email');
        $admin->password = $request->input('password');
        $admin->profile_picture = $fileNameToStore;
        $admin->phone_number = $request->input('phone_number');
        $admin->address = $request->input('address');

        $admin->save();

        $user->save();

        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }

        $admin->user_id = $user->id;

        $admin->save();

        //Redirect to the users.index view and display message
        return redirect()->route('users.index')
            ->with('success',
             'Utilisateur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); //Get user with specified id
        //$roles = Role::get(); //Get all roles
        $roles = Role::whereNotIn('id', array(3,2))->get();

        return view('admin.users.edit', compact('user', 'roles')); //pass user and roles data to view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); //Get role specified by id

        //Validate name, email and password fields
        $this->validate($request, [
            'name' => 'required|max:120',
            'firstname' => 'required|max:120',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'required',
            'address' => 'required',
            'profile_picture' => 'image|nullable',
        ]);

        if ($request->hasfile('profile_picture')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension = $request->file('profile_picture')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('profile_picture')->storeAs('public/profile_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'avatar.jpg';
        }

        $user->name = $request->input('name');
        $user->firstname = $request->input('firstname');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        if ($request->hasfile('profile_picture')) {
            $user->profile_picture = $fileNameToStore;
        }

        $admin = Admin::Where('user_id', $user->id)->first();

        $admin->name = $request->input('name');
        $admin->firstname = $request->input('firstname');
        $admin->email = $request->input('email');
        $admin->password = $request->input('password');

        if ($request->hasfile('profile_picture')) {
            $admin->profile_picture = $fileNameToStore;
        }

        $admin->phone_number = $request->input('phone_number');
        
        $admin->address = $request->input('address');

        $admin->save();

        $user->save();

        $roles = $request['roles']; //Retreive all roles

        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return redirect()->route('users.index')
            ->with('success',
             'Utilisateur edité avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find a user with a given id and delete
        $user = User::findOrFail($id);
        $admin = Admin::Where('user_id', $user->id)->first();
  
        if ($user->profile_picture != 'avatar.jpg') {
            Storage::delete('public/profile_images/'.$user->profile_picture);
        }
        $admin->delete();
        $user->delete();

        return redirect()->route('users.index')
            ->with('success',
             'Utilisateur supprimé avec succès.');
    }
}
