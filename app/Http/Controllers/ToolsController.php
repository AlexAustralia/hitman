<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class ToolsController extends Controller
{
    // Users index page
    public function users()
    {
        // Get all users
        $users = User::all();

        return view('tools.users', compact('users'));
    }

    // Create New User
    public function create_user()
    {
        // Get all user roles
        $roles = Role::all();

        return view('tools.create-user', compact('roles'));
    }

    // Change User Password page
    public function get_change_password()
    {
        // Get all users
        $users = User::all();

        return view('tools.change-password', compact('users'));
    }

    // Save created/edited user data
    public function save_user(Request $request)
    {
        // Get form data
        $input = Input::all();

        // Validate form
        $this->validate($request, [
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        if (isset($input['id'])){

            // Save edited user
            $user = User::find($input['id']);
        }
        else {

            // Save new user
            $this->validate($request, [
                'email' => 'required|unique:users',
                'name' => 'required'
            ]);

            $user = new User();
        }

        // Compare passwords, if they coincide, save, otherwise throw the error
        if ($input['password'] == $input['confirm_password']){

            if (isset($input['name'])) $user->name = $input['name'];
            if (isset($input['email'])) $user->email = $input['email'];
            if (isset($input['role_id'])) $user->role_id = $input['role_id'];
            $user->password = Hash::make($input['password']);

            $user->save();

            return redirect('tools/users')->with('success', 'User has been saved/updated successfully');
        }
        else {
            if (isset($input['id'])) {
                return redirect('tools/change-password')->with('error', 'Entered passwords do not coincide');
            }
            else {
                return redirect('tools/users/create')->with('error', 'Entered passwords do not coincide');
            }
        }
    }
}
