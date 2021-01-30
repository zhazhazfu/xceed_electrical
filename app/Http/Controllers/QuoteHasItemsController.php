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

            //$tmp_quotes = Quote::get();
            // foreach($tmp_perpoint as $key => $data)
            // {
            //     $data->type = 'Per Point Quote';
            //     $data->desc = Category::where('pk_category_id',SubCategory::where('pk_subcategory_id',Items::where('pk_item_id', QuoteHasItem::where('fk_quote_id',Perpointquote::first()->pk_quote_id)->first()->fk_item_id)->first()->fk_subcategory_id )->first()->fk_category_id)->first()->category_name;
            // }
            // foreach($tmp_quotes as $key => $data)
            // {
            //     $data->type = 'Fixed Quote';
            //     $data->desc = Category::where('pk_category_id',SubCategory::where('pk_subcategory_id',Items::where('pk_item_id', QuoteHasItem::where('fk_quote_id',Quote::first()->pk_quote_id)->first()->fk_item_id)->first()->fk_subcategory_id )->first()->fk_category_id)->first()->category_name;
            // }
            // $quotes = $tmp_quotes->merge($tmp_perpoint);
    
            //return view('history',['pageHeading' => $pageHeading])->with(['quotes'=>$quotes]);
            
            return view('history', compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'items', 'itemhasmaterials', 'quoteterms', 'discounts', 'grossmargins','prefixes','inclusion','exclusion'));
        }

        public function show($id="")
    {
        // $pageHeading = 'Preview';
        // $category = Category::find($id);
        // $subCategories = $category->subCategories;
        // $categoryName = $category->category_name;

  
        return view('history', compact('pageHeading', 'subCategories', 'categoryName'));
    } 
}

