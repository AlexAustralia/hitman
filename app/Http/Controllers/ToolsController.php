<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

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

        return view('tools.edit-user', compact('roles'));
    }

    // Edit User
    public function edit_user($id)
    {
        // Get all user roles and the user
        $roles = Role::all();
        $user = User::find($id);

        return view('tools.edit-user', compact('user', 'roles'));
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

        // If password should be entered, check if it is entered
        if (isset($input['password'])) {
            $this->validate($request, [
                'password' => 'required',
                'confirm_password' => 'required'
            ]);

            // Compare passwords, if they do not coincide, throw the error
            if ($input['password'] != $input['confirm_password']) return redirect(URL::previous())->with('error', 'Entered passwords do not coincide');
        }

        // If name should be entered, check if it is entered
        if (isset($input['name'])) {
            $this->validate($request, [
                'name' => 'required'
            ]);
        }

        if (isset($input['id'])){

            // User exists
            $user = User::find($input['id']);
        }
        else {

            // New user
            $this->validate($request, [
                'email' => 'required|unique:users',
            ]);

            $user = new User();
        }

        // Save user data
        if (isset($input['name'])) $user->name = $input['name'];
        if (isset($input['email'])) $user->email = $input['email'];
        if (isset($input['role_id'])) $user->role_id = $input['role_id'];
        if (isset($input['password'])) $user->password = Hash::make($input['password']);

        // Try to save user. If we catch exception then this email is already used
        try {
            $user->save();
        } catch (QueryException $e) {
            return redirect(URL::previous())->with('error', 'Entered Email | Login is already used');
        }

        return redirect('tools/users')->with('success', 'User has been saved/updated successfully');
    }
}
