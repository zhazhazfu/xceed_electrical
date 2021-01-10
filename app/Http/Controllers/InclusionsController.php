<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\GrossMargin;
use App\CompanyCost;
use App\EmployeeCost;
use App\Customer;
use App\Inclusions;
class InclusionsController extends Controller
{
    public function index()
    {
        //
        $pageHeading = 'Inclusions';
        $inclusions = Inclusions::all();
        return view('inclusions', compact('pageHeading','inclusions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'inclusion_Content' => 'required',
       
        ]);

        $inclusions = new Inclusions([
            'inclusion_Content' => $request->get('inclusion_Content')
        ]);


        $inclusions->save();
        return back()->with('success', 'Inclusions added');

    
    }
}