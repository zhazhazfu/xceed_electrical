<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\prefix;

class PrefixController extends Controller
{
    public function index()
    {
        $pageHeading = 'Quote Prefixes';
        $prefixes = prefix::all();
        return view('prefix', compact('pageHeading','prefixes'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'prefix' => 'required'
        ]);

        $prefixes = new prefix([
            'prefix' => $request->get('prefix')
        ]);

        $prefixes->save();
        return back()->with('success', 'prefix added');
    }
}