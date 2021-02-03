<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/*use App\Perpointquote;*/
use App\Quote;
use App\BusinessDetail;
use App\Customer;
use App\Category;
use App\SubCategory;
use App\Items;
use App\QuoteTerm;
use App\Inclusions;
use App\Exclusions;
use App\CompanyCost;
use App\EmployeeCost;
use App\Discount;
use App\GrossMargin;
Use App\prefix;
use App\QuoteHasItem;
class DraftlistController extends Controller
{
    public function index()
    {
        //
        $pageHeading = 'Draft list';

       /* $tmp_perpoint = Perpointquote::where('perpoint_status',1)->get();*/
        $tmp_quotes = Quote::where('quote_status',1)->get();

        /*foreach($tmp_perpoint as $key => $data)
                    {
                        $data->type = 'per point quote';
                       
                    }*/
        foreach($tmp_quotes as $key => $data)
                    {
                        $data->type = 'fixed quote';
                        
                    }
        //$quotes = $tmp_quotes->merge($tmp_perpoint);
        $quotes = $tmp_quotes;


        return view('draftlist',compact('pageHeading','quotes'));
    }

    public function edit(Request $request, $id)
    {
    		$pageHeading = 'Quoting';
    		$quote= Quote::find($id);
            $quotes = Quote::all();
            $businessDetails = BusinessDetail::first();
            $customers = Customer::all();
            $categories = Category::all();
            $subCategories = SubCategory::all();
            $items = Items::all();
            $quoteterms = QuoteTerm::all();
            $exclusions = Exclusions::all();
            $inclusions = Inclusions::all();
            $discounts = Discount::all();
            $grossmargins = GrossMargin::all();
            $prefixes = Prefix::all();
            $companyCosts = CompanyCost::all();
            $employeeCosts = EmployeeCost::all();
            $grossMargin = GrossMargin::get()->last();
    
            return view('draft', compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'items', 'quoteterms', 'discounts', 'grossmargins', 'exclusions', 'inclusions', 'companyCosts', 'employeeCosts', 'prefixes','quote','grossMargin'));
    }

    public function update(Request $request)
    {

        if ($request->has('save')) {

            $status = 1;

        }
        else
        {
            $status = 2;

             $this->validate($request, [
            'customer_name' => 'required',
            'quote_prefix' => 'required',
            'item_number' => 'required',
            'term_name' => 'required',
            'inc_name' => 'required',
            'exc_name' => 'required',
            'price' => 'required',
            'gst_price' => 'required'
            ]);
        }
        
       
        
        $quote = Quote::where('pk_quote_id',$request->get('quote_id'))->first();
        $quote->fk_customer_id = $request->get('customer_name');
        $quote->fk_user_id = Auth::user()->pk_user_id;
        $quote->fk_term_id = $request->get('term_name'); 
        $quote->inclusions = $request->get('inc_name');
        $quote->exclusions = $request->get('exc_name');
        $quote->fk_prefix_id = $request->get('quote_prefix');
        $quote->quote_number = $request->get('quote_number');
        $quote->quote_status = $status;
        $quote->quote_comment = $request->get('quote_comment');
        $quote->save();

        foreach ($request->get('item_number') as $key => $value) {
        	if ($key<$request->get('counter')) {
        		
        	}
        	else
        	{
	            $QuoteHasItem = new QuoteHasItem();
	            $QuoteHasItem->fk_quote_id = $quote->pk_quote_id;
	            $QuoteHasItem->fk_item_id = $value;
	            $QuoteHasItem->price = $request->get('price');
	            $QuoteHasItem->GST_price = $request->get('gst_price');
	            $QuoteHasItem->save();
        	}
        }
        return redirect('/history/')->with('success', 'Quote Added');

        // $pageHeading = 'Preview';
        // $businessDetails = BusinessDetail::first();
        // $quotes = Quote::all();
        // $customers = Customer::all();
        // $categories = Category::all();
        // $subCategories = SubCategory::all();
        // $items = Items::all();
        // $quoteterms = QuoteTerm::all();
        // $discounts = Discount::all();
        // $grossmargins = GrossMargin::all();
        // $prefixes = Prefix::all();
        // $inclusion = Inclusions::all();
        // $quotehasitem = QuoteHasItem::all();
        // $pageid = $quote->pk_quote_id;
        // return View('preview',compact('pageHeading','quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'items', 'quoteterms', 'discounts', 'grossmargins','prefixes','inclusion' ,'pageid','quotehasitem'));
    }
}
