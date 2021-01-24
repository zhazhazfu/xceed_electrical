<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
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
use PDF;

class PreviewController extends Controller
{
    public function index(Request $request)
        {   
            $customers = Customer::all();
            // print_r($request->input());
            // $request->session()->put()
            $pageHeading = 'Preview';
            $quotes = Quote::all();
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
            
    
            return view('preview', compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'priceLists', 'quoteterms', 'discounts', 'grossmargins','prefixes','inclusion'));
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
        $pageHeading = 'Preview';
        $category = Category::find($id);
        $subCategories = $category->subCategories;
        $categoryName = $category->category_name;
        
  
        return view('preview', compact('pageHeading', 'subCategories', 'categoryName'));
    } 

    public function generatePDF()
    {
        
        $pageHeading = 'Preview';
        $quotes = Quote::all();
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
        $pdf =  PDF::loadView('preview',compact('pageHeading','quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'priceLists', 'quoteterms', 'discounts', 'grossmargins','prefixes','inclusion' ));
  
        return $pdf->download('Quote.pdf');
    }
}
