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
        $pageHeading = 'Preview';
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

        return view('preview', compact('pageHeading', 'quoteid','quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'items', 'quoteterms','prefixes', 'pageid'));
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
