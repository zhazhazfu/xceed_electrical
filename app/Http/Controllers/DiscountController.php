<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount;
use App\EmployeeCost;
use App\GrossMargin;
use App\CompanyCost;
use Faker\Provider\ar_JO\Company;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $pageHeading = 'Discounts';

        $discounts = Discount::all();
  
        return view('discounts', compact('pageHeading', 'discounts'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'discount_name' => 'required',
        ]);

        $newDiscount = new Discount([
            'discount_name'  => $request->get('discount_name'),
            'discount_rate'  => $request->get('discount_rate'),
            'discount_archived'	=> $request->get('discount_archived')
        ]);

        $newDiscount->save();
        return back()->with('success', 'Discount added');    
    }

    public function edit($pk_discount_id)
    {
        $pageHeading = 'Discounts';
        $discounts = Discount::find($pk_discount_id);

        return view('editlayouts.discountedit', compact('discounts', 'pk_discount_id', 'pageHeading'));
    }

    public function update(Request $request, $pk_discount_id)
    {

        $this->validate($request,[
            'discount_name' => 'required',
        ]);
        
        $discounts = Discount::find($pk_discount_id);
        $discounts->discount_name = $request->get('discount_name');
        $discounts->discount_rate = $request->get('discount_rate');
        $discounts->discount_archived = $request->get('discount_archived');
        $discounts->save();

        return redirect()->route('discounts.index')->with('success', 'Discount updated');
    }

}
