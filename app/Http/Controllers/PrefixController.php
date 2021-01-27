<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Prefix;

class PrefixController extends Controller
{
    public function index()
    {
        $pageHeading = 'Quote Prefixes';
        $prefixes = Prefix::all();
        return view('prefix', compact('pageHeading','prefixes'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'prefix_name' => 'required'
        ]);

        $prefixes = new Prefix([
            'prefix_name' => $request->get('prefix_name')
        ]);

        $prefixes->save();
        return back()->with('success', 'prefix added');
    }
}