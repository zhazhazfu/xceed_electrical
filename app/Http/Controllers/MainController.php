<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $pageHeading = 'Login';

        return view('login', compact('pageHeading'));
    }

    function checklogin(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required',
            'user_password'  => 'required'
        ]);
        
        $user_data = array(
            'user_name' => $request->get('user_name'),
            'password' => $request->get('user_password'),
        );
        
        if(Auth::attempt($user_data))
        {

            return redirect()->route('dashboard')->with('success', 'Login Successful');
        }
        else
        {
            return back()->with('error', 'Incorrect login details');
        }
    }

    function successlogin()
    {

        return redirect()->route('dashboard')->with('success', 'Login Successful');
    }

    function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}