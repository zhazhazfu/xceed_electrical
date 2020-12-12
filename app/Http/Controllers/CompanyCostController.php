<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyCost;
use App\EmployeeCost;

class CompanyCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageHeading = 'Company Costs';
        $companyCosts = CompanyCost::all();
  
        return view('companycosts', compact('pageHeading', 'companyCosts'));
    }

    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'companycost_name' => 'required',
        ]);

        $newCompanyCost = new CompanyCost([
            'companycost_name'  => $request->get('companycost_name'),
            'companycost_yearly'  => $request->get('companycost_yearly'),
            'companycost_archived'	=> $request->get('companycost_archived')
        ]);

        $newCompanyCost->save();
        return back()->with('success', 'Company Cost added');    
    }

    public function edit($pk_companycost_id)
    {
        $pageHeading = 'Company Costs';
        $companyCosts = CompanyCost::find($pk_companycost_id);

        return view('editlayouts.companycostedit', compact('companyCosts', 'pk_companycost_id', 'pageHeading'));
    }

    public function update(Request $request, $pk_companycost_id)
    {

        $this->validate($request,[
            'companycost_name' => 'required',
        ]);
        
        $companyCosts = CompanyCost::find($pk_companycost_id);
        $companyCosts->companycost_name = $request->get('companycost_name');
        $companyCosts->companycost_yearly = $request->get('companycost_yearly');
        $companyCosts->companycost_archived = $request->get('companycost_archived');
        $companyCosts->save();

        return redirect()->route('companycosts.index')->with('success', 'Company cost updated');
    }

    public function totalCosts()
    {
        $pageHeading = 'Total Business Costs';
        $companyCosts = CompanyCost::all();
        $employeeCosts = EmployeeCost::all();
        return view('totalcosts', compact('pageHeading', 'companyCosts', 'employeeCosts'));
    }

}
