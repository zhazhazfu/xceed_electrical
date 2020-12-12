<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    
    {
        $users = User::all();

        return view('users', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required',
            'user_firstlast' => 'required',
            'password' => 'required'
        ]);

        $newUser = new User([
            'user_name' => $request->get('user_name'),
            'user_firstlast' => $request->get('user_firstlast'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
            'user_archived' => $request->get('user_archived')
        ]);
        $newUser->save();
        return back()->with('success', 'User added');
    }

    public function edit($pk_user_id)
    {
        $users = User::find($pk_user_id);

        return view('editlayouts.useredit', compact('users', 'pk_user_id'));
    }

    public function update(Request $request, $pk_user_id)
    {

        $this->validate($request,[
            'user_name' => 'required',
            'user_firstlast' => 'required',
        ]);

        $password = $request->get('password');
        
        $users = User::find($pk_user_id);
        $users->user_name = $request->get('user_name');
        $users->user_firstlast = $request->get('user_firstlast');
        if ($password != "") {
            $users->password = Hash::make($request->get('password'));
        }
        $users->role = $request->get('role');
        $users->user_archived = $request->get('user_archived');
        $users->save();

        return redirect()->route('users.index')->with('success', 'User updated');
    }

}

