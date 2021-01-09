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
            'term_name' => 'required',
            'term_body' => 'required',
            'exclusion_title' => 'required',
            'exclusion_Content' => 'required',
            'inclusion_title' => 'required',
            'inclusion_Content' => 'required'
        ]);

        $quoteterms = new QuoteTerm([
            'term_name' => $request->get('term_name'),
            'term_body' => $request->get('term_body')
        ]);

        $inclusions = new Inclusions([
            'inclusion_title' => $request->get('inclusion_title'),
            'inclusion_Content' => $request->get('inclusion_Content')
        ]);
        
        $exclusions = new Exclusions([
            'exclusion_title' => $request->get('exclusion_title'),
            'exlusion_Content' => $request->get('exclusion_Content')
        ]);

        $quoteterms->save();
        return back()->with('success', 'Terms and Condition added');

        $inclusions->save();
        return back()->with('success', 'Inclusion added');

        $exclusions->save();
        return back()->with('success', 'Exclusion added');
    }
}
