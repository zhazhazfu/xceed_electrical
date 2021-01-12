<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\GrossMargin;
use App\QuoteTerm;
use App\Exclusions;
use App\Inclusions;
use App\CompanyCost;
use App\EmployeeCost;
use App\Customer;
class QuotesettingController extends Controller
{
    public function index()
    {
        //
        $pageHeading = 'Quote Setting';
        $quoteterms = QuoteTerm::all();
        $inclusions = Inclusions::all();
        return view('quotesetting', compact('pageHeading','quoteterms','inclusions'));
    }

    // public function show($id="")
    // {
    //     $pageHeading = 'Price List';
    //     $category = Category::find($id);
    //     $materials = Material::all();
    //     $subCategories = $category->subCategories;
    //     $categoryName = $category->category_name;
    //     $grossMargins = GrossMargin::all();
    //     $companyCosts = CompanyCost::all();
    //     $employeeCosts = EmployeeCost::all();
    //     $page_id = $id;
    //     return view('pricelists', compact('pageHeading', 'materials', 'subCategories', 'categoryName', 'page_id', 'grossMargins', 'companyCosts', 'employeeCosts'));
    // }

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
