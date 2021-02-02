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
use App\Exclusions;
use App\Items;
use App\QuoteHasItem;
use PDF;

class PreviewController extends Controller
{

    public function show($id="")
    {
        $quoteid = Quote::find($id);
        $quotes = Quote::all();
        $businessDetails = BusinessDetail::first();
        $customers = Customer::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $items = Items::all();
        $quoteterms = QuoteTerm::all();
        $prefixes = prefix::all();
        $quotehasitem = QuoteHasItem::all();
        $pageid = $id;

        return view('preview', compact( 'quoteid','quotes', 'quotehasitem', 'businessDetails', 'customers', 'categories', 'subCategories', 'items', 'quoteterms','prefixes', 'pageid'));
    } 

    public function generatePDF($id)
    {
        
        $quoteid = Quote::find($id);
        $quoteid->quote_status = 3;
        $quoteid->save();
        $quotes = Quote::all();
        $businessDetails = BusinessDetail::first();
        $customers = Customer::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $items = Items::all();
        $quoteterms = QuoteTerm::all();
        $prefixes = prefix::all();
        $quotehasitem = QuoteHasItem::all();
        $pageid = $id;

        $pdf =  PDF::loadView('preview',compact('quoteid','quotes', 'quotehasitem', 'businessDetails', 'customers', 'categories', 'subCategories', 'items', 'quoteterms','prefixes', 'pageid' ));
        return $pdf->download('Quote.pdf');
       
    }
}
