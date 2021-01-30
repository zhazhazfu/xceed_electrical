<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use App\BusinessDetail;
use App\Customer;
use App\Category;
use App\SubCategory;
use App\QuoteTerm;
use App\Discount;
use App\GrossMargin;
use App\prefix;
use App\Inclusions;
use App\Exclusions;
use App\ItemHasMaterials;
use App\Items;
use App\QuoteHasItem;
use PDF;

class QuoteHasItemsController extends Controller
{
    public function index(Request $request)
        {   
            $pageHeading = 'History';
            $quotes = Quote::all();
            $businessDetails = BusinessDetail::first();
            $customers = Customer::all();
            $categories = Category::all();
            $subCategories = SubCategory::all();
            $items = Items::all();
            $itemhasmaterials = ItemHasMaterials::all();
            $quoteterms = QuoteTerm::all();
            $discounts = Discount::all();
            $grossmargins = GrossMargin::all();
            $prefixes = prefix::all();
            $inclusion = Inclusions::all();
            $exclusion = Exclusions::all();
            
            return view('history', compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'items', 'itemhasmaterials', 'quoteterms', 'discounts', 'grossmargins','prefixes','inclusion','exclusion'));
        }

    public function edit($quote_id)
    {
        $pageHeading = 'Quote Status and Comment';
        $quotesid = Quote::find($quote_id);
        $quotes = Quote::all();

        return view('editlayouts.pricelistedit', compact('quotesid', 'quotes', 'pageHeading'));
    }

    public function update(Request $request, $quote_id)
    {

        $this->validate($request,[
            'quote_status' => 'required',
            'quote_comment' => 'required',
        ]);

        $quotes = Quote::find($quote_id);
        $quotes->quote_status = $request->get('quote_status');
        $quotes->quote_comment = $request->get('quote_comment');
        $quotes->save();

        return redirect('/histort/'.$quote_id)->with('success', 'Product updated');
    }


}

