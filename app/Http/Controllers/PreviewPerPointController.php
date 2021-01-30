<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perpointquote;
use App\BusinessDetail;
use App\Customer;
use App\Category;
use App\SubCategory;
use App\PriceList;
use App\QuoteTerm;
use App\Discount;
use App\GrossMargin;
use App\preview;
use App\prefix;
use App\Inclusions;
use App\Exclusions;
use PDF;

class PreviewPerPointController extends Controller
{
    public function index(Request $request)
        {   
            
            // print_r($request->input());
            // $request->session()->put()
            $pageHeading = 'Preview';
            $perpointquotes = Perpointquote::all();
            $customers = Customer::all();
            $businessDetails = BusinessDetail::first();
            $customers = Customer::all();
            $categories = Category::all();
            $subCategories = SubCategory::all();
            $priceLists = PriceList::all();
            $quoteterms = QuoteTerm::all();
            $discounts = Discount::all();
            $grossmargins = GrossMargin::all();
            $prefixes = prefix::all();
            $inclusion = Inclusions::all();
            $exclusion = Exclusions::all();
            
    
            return view('previewperpointPDF', compact('pageHeading', 'perpointquotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'priceLists', 'quoteterms', 'discounts', 'grossmargins','prefixes','inclusion','exclusion'));
        }

    //     public function show($id="")
    // {
    //     // $pageHeading = 'Preview';
    //     // $category = Category::find($id);
    //     // $subCategories = $category->subCategories;
    //     // $categoryName = $category->category_name;

  
    //     return view('preview', compact('pageHeading', 'subCategories', 'categoryName'));
    // } 
      
    public function show(Request $request)
    {

        
        print_r($request->input());
        $request->session()->put('name',$request->input('job'));
        // $pageHeading = 'Preview';
        // $category = Category::find($id);
        // $subCategories = $category->subCategories;
        // $categoryName = $category->category_name;
        return view('previewperpointPDF')->with('name',$request->session()->get('name'));
  
        //return view('preview', compact('pageHeading', 'subCategories', 'categoryName'));
    } 

    public function generatePDF()
    {
        
        $pageHeading = 'Preview';
        $perpointquotes = Perpointquote::all();
        $businessDetails = BusinessDetail::first();
        $customers = Customer::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $priceLists = PriceList::all();
        $quoteterms = QuoteTerm::all();
        $discounts = Discount::all();
        $grossmargins = GrossMargin::all();
        $prefixes = prefix::all();
        $inclusion = Inclusions::all();
        $pdf =  PDF::loadView('previewperpointPDF',compact('pageHeading','perpointquotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'priceLists', 'quoteterms', 'discounts', 'grossmargins','prefixes','inclusion' ));
  
        return $pdf->download('Quote.pdf');
    }
}
