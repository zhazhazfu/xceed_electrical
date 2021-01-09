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
use PDF;

class PreviewPDFController extends Controller
{
    public function index()
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
            
    
            return view('previewPDF', compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'priceLists', 'quoteterms', 'discounts', 'grossmargins'));
        }

        public function show($id="")
    {
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
            $pdf = PDF::loadView('previewPDF',compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'priceLists', 'quoteterms', 'discounts', 'grossmargins'));
  
        return $pdf->download('Quote.pdf');
    }
}
