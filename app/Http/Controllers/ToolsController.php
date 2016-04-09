<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class ToolsController extends Controller
{
    // Change User Password page
    public function get_change_password()
    {
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
            ]);

            $user = new User();
        }

        // Compare passwords, if they coincide, save, otherwise throw the error
        if ($input['password'] == $input['confirm_password']){
            $user->password = Hash::make($input['password']);
            $user->save();

            return redirect('tools/change-password')->with('success', 'User data has been saved successfully');
        }
        else {
            return redirect('tools/change-password')->with('error', 'Entered passwords do not coincide');
        }
    }
}
