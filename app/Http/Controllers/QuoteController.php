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

class QuoteController extends Controller
{
    public function index()
        {
            $pageHeading = 'Quoting';
            $quotes = Quote::all();
            $businessDetails = BusinessDetail::first();
            $customers = Customer::all();
            $categories = Category::all();
            $subCategories = SubCategory::all();
            $priceLists = PriceList::all();
            $quoteterms = QuoteTerm::all();
            $discounts = Discount::all();
            $grossmargins = GrossMargin::all();
    
            return view('quoting', compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'priceLists', 'quoteterms', 'discounts', 'grossmargins'));
        }

        public function show($id="")
    {
        $pageHeading = 'Quoting';
        $category = Category::find($id);
        $subCategories = $category->subCategories;
        $categoryName = $category->category_name;
  
        return view('quoting', compact('pageHeading', 'subCategories', 'categoryName'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'quote_number' => 'required'
        ]);

        $newQuote = new Quote([
            'quote_number'=> $request->get('quote_number'),
            'quote_status'=> $request->get('quote_status'),
            'quote_revisionnumber'=> $request->get('quote_revisonnumber'),
            'quote_comment'=> $request->get('quote_comment'),
        ]);
    }

    public function update(Request $request, $pk_quote_id)
    {

        $this->validate($request,[
                    'customer_name' => 'required',
                ]);

             $quotes= Quote::find($pk_quote_id); 
             $quotes->quote_number = $request->get('quote_number');
             $quotes->quote_status = $request->get('quote_status');
             $quotes->quote_revisionnumber = $request->get('quote_revisonnumber');
             $quotes->quote_comment = $request -> get('quote_comment');
             $quotes->save();

        return redirect()->route('quote.index')->with('success', 'Quote updated');
    }

    // public function QuoteNumber()
    // {
    //     $latest = App\Quote::latest()->first();

    //     if (! $latest)
    //     {
    //         return 'Q0001';
    //     }

    //     $String = preg_replace("/[^0-9\.]/", '', $latest->quote_number);

    //     return 'q'. sprint('%04d',$String+1);
    // }

}
