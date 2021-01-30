<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\GrossMargin;
use App\CompanyCost;
use App\EmployeeCost;
use App\Customer;

use App\Perpointquote;
use App\Quote;
use App\QuoteHasItem;
use App\Items;
use App\SubCategory;
use App\Category;

class HistoryController extends Controller
{
    public function index()
    {
        $pageHeading = 'History';
        /*$tmp_perpoint = Perpointquote::get();
        $tmp_quotes = Quote::get();*/
        $tmp_perpoint = Perpointquote::where('perpoint_status','!=',3)->get();
        $tmp_quotes = Quote::where('quote_status','!=',3)->get();


        foreach($tmp_perpoint as $key => $data)
        {
            $data->type = 'Per Point Quote';
            $data->desc = Category::where('pk_category_id',SubCategory::where('pk_subcategory_id',Items::where('pk_item_id', QuoteHasItem::where('fk_quote_id',Perpointquote::first()->pk_quote_id)->first()->fk_item_id)->first()->fk_subcategory_id )->first()->fk_category_id)->first()->category_name;
        }
        foreach($tmp_quotes as $key => $data)
        {
            $data->type = 'Fixed Quote';
            $data->desc = Category::where('pk_category_id',SubCategory::where('pk_subcategory_id',Items::where('pk_item_id', QuoteHasItem::where('fk_quote_id',Quote::first()->pk_quote_id)->first()->fk_item_id)->first()->fk_subcategory_id )->first()->fk_category_id)->first()->category_name;
        }
        $quotes = $tmp_quotes->merge($tmp_perpoint);

        return view('history',['pageHeading' => $pageHeading])->with(['quotes'=>$quotes]);
    }
}
