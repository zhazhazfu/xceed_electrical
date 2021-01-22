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
use App\Quote_has_item;
use App\Items;
use App\SubCategory;
use App\Category;

class HistoryController extends Controller
{
    public function index()
    {
    	
    	 
        //
        $pageHeading = 'History';

        $tmp_perpoint = Perpointquote::get();
        $tmp_quotes = Quote::get();

        foreach($tmp_perpoint as $key => $data)
                    {
                        $data->type = 'per point quote';
                        $data->desc = Category::where('pk_category_id',SubCategory::where('pk_subcategory_id',Items::where('pk_item_id', Quote_has_item::where('fk_quote_id',Perpointquote::first()->pk_quote_id)->first()->fk_item_id)->first()->fk_subcategory_id )->first()->fk_category_id)->first()->category_name;
                    }
        foreach($tmp_quotes as $key => $data)
                    {
                        $data->type = 'fixed quote';
                        $data->desc = Category::where('pk_category_id',SubCategory::where('pk_subcategory_id',Items::where('pk_item_id', Quote_has_item::where('fk_quote_id',Quote::first()->pk_quote_id)->first()->fk_item_id)->first()->fk_subcategory_id )->first()->fk_category_id)->first()->category_name;
                    }
        $quotes = $tmp_quotes->merge($tmp_perpoint);
       // return $quotes;

        return view('history',[
            'pageHeading' => $pageHeading])->with(['quotes'=>$quotes]);
    }
}
