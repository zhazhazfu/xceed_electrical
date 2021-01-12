<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\GrossMargin;
use App\CompanyCost;
use App\EmployeeCost;
use App\Customer;
use App\Exclusions;
class ExclusionsController extends Controller
{
    public function index()
    {
        //
        $pageHeading = 'Exclusions';
        $exclusions = Exclusions::all();
        return view('exclusions', compact('pageHeading','exclusions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'exclusion_name' => 'required',
            'exclusion_Content' => 'required'
       
        ]);

        $exclusions = new Exclusions([
            'exclusion_name' => $request->get('exclusion_name'),
            'exclusion_Content' => $request->get('exclusion_Content')
        ]);


        $exclusions->save();
        return back()->with('success', 'Exclusions added');
    }
}