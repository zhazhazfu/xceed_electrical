<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EmployeeCost;
use App\Discount;
use App\GrossMargin;
use App\CompanyCost;
class GrossMarginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grossmargin = GrossMargin::all();
        $employeeCosts = EmployeeCost::all();
        $companyCosts = CompanyCost::all();
        return view('grossmargin', compact('grossmargin','employeeCosts','companyCosts'));
    }

    // public function show($pk_gm_id)
    // {
    //     $grossmargin = GrossMargin::find($pk_gm_id)
    //                             ->where('id',$pk_gm_id=30)
    //                             ->first();
       
    //     return view('grossmargin', compact('grossmargin'));
    // }


    public function store(Request $request)
    {
        $this->validate($request,[
            'gm_rate' => 'required',
        ]);

        $newGrossMargin = new GrossMargin([
            'gm_rate'  => $request->get('gm_rate'),
        ]);

        $newGrossMargin->save();
        return back()->with('success', 'GM Rate Added');    
    }

    public function edit($pk_gm_id)
    {
        $grossmargin = GrossMargin::find($pk_gm_id);

        return view('editlayouts.grossmarginedit', compact('grossmargin', 'pk_gm_id'));
    }

    public function update(Request $request, $pk_gm_id)
    {

        $this->validate($request,[
                    'gm_rate' => 'required',
        ]);

        $grossmargin = GrossMargin::find($pk_gm_id);
        $grossmargin->gm_rate = $request->get('gm_rate');
        $grossmargin->save();

        return redirect()->route('grossmargin.index')->with('success', 'GM rate updated');
    }

}
