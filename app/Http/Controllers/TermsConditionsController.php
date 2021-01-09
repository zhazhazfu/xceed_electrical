<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\GrossMargin;
use App\CompanyCost;
use App\EmployeeCost;
use App\Customer;
use App\QuoteTerm;
class TermsConditionsController extends Controller
{
    public function index()
    {
        //
        $pageHeading = 'Quote Setting';
        $quoteterms = QuoteTerm::all();
        return view('termsconditions', compact('pageHeading','quoteterms'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'term_body' => 'required',
       
        ]);

        $quoteterms = new QuoteTerm([
            'term_body' => $request->get('term_body')
        ]);


        $quoteterms->save();
        return back()->with('success', 'Terms and Condition added');

    
    }
}