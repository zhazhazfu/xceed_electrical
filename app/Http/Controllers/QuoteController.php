<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use App\Perpointquote;
use App\BusinessDetail;
use App\Customer;
use App\Category;
use App\SubCategory;
use App\PriceList;
use App\Items;
use App\QuoteTerm;
use App\Inclusions;
use App\Exclusions;
use App\Quote_has_item;
use App\Discount;
use App\GrossMargin;
Use App\prefix;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Arr;

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
            $exclusions = Exclusions::all();
            $inclusions = Inclusions::all();
            $discounts = Discount::all();
            $grossmargins = GrossMargin::all();
            $prefixes = prefix::all();
    
            return view('quoting', compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'priceLists', 'quoteterms', 'discounts', 'grossmargins', 'exclusions', 'inclusions','prefixes'));
        }

        public function show($id="")
    {
        $pageHeading = 'Quoting';
        $category = Category::find($id);
        $subCategories = $category->subCategories;
        $categoryName = $category->category_name;
  
        return view('quoting', compact('pageHeading', 'subCategories', 'categoryName'));
    }

    public function getSubcategories($id="")
    {
        $sCatNames = array();
        $sCatIDs = array();
        // $result = SubCategory::where('fk_category_id', '=', $id);

        $result = SubCategory::where('fk_category_id', '=', $id)->get()->toArray();

        // $aaa = var_export($result);

        // $subCatCount = count($subCategories);

        // foreach ($sCatLength as ) {
        //     foreach ($subCat->pk_subcategory_id as $id) {
        //         $sCatIDs[$id] = $id;
        //     }
        //     foreach($subCat->subcategory_name as $name) {
        //         $sCatNames[$id] = $subCategories[$id]->subcategory_name;
        //     }
        // }

        $sCatNames = Arr::pluck($result, 'subcategory_name');
        $sCatIDs = Arr::pluck($result, 'pk_subcategory_id');

        return response()->json([
            'id' => $sCatIDs,
            'name' => $sCatNames, 
        ]);

    }

    public function getItems($id="")
    {
        $iNames = array();
        $iIDs = array();
        $result = Items::where('fk_subcategory_id', '=', $id)->get()->toArray();

        $iNames = Arr::pluck($result, 'item_number');
        $iIDs = Arr::pluck($result, 'pk_item_id');

        return response()->json([
            'id' => $iIDs,
            'name' => $iNames, 
        ]);

    }

    public function getDescription($id="")
    {

        $result = Items::where('pk_item_id', '=', $id)->first();

        $resultName = $result->item_description;

        return response()->json([
            'id' => $resultName, 
        ]);

    }

    // public function update(Request $request, $page_id, $pk_quote_id)
    // {

    //     $this->validate($request,[
    //         'quote_id' => 'required',
    //         'fk_business_id' => 'required',
    //         'fk_customer_id' => 'required',
    //         'fk_user_id' => 'required',
    //         'fk_item_id' => 'required',
    //         'fk_in_id' => 'required',
    //         'fk_ex_id' => 'required',
    //         'fk_prefix_id' => 'required',
    //     ]);
        
    //     $quotes = Quote::find($pk_quote_id);
    //     $quotes->customer_name = $request->get('customer_name');
    //     $quotes->fk_prefix_id = $request->get('prefix');
    //     $quotes->fk_subcategory_id = $request->get('fk_subcategory_id');
    //     $quotes->item_description = $request->get('item_description');
    //     $quotes->fk_material_id = $request->get('fk_material_id');
    //     $quotes->item_estimatedtime = $request->get('item_estimatedtime');
    //     $quotes->item_servicecall = $request->get('item_servicecall');
    //     $quotes->item_archived = $request->get('item_archived');
    //     $quotes->save();

    //     return redirect('/preview/'.$page_id)->with('success', 'Quote updated');
    // }

    public function store(Request $request)
    {
        $this->validate($request,[
            'quote_id' => 'required',
            'fk_business_id' => 'required',
            'fk_customer_id' => 'required',
            'fk_user_id' => 'required',
            'fk_item_id' => 'required',
            'fk_in_id' => 'required',
            'fk_ex_id' => 'required',
            'fk_prefix_id' => 'required',
        ]);
        
        $quotes = Quote::find($pk_quote_id);

        $quotes = new Quote([
            
            'quote_id' => $request->get('quote_id'),
            'fk_buiness_id' => $request->get('fk_buiness_id'),
            'fk_customer_id'=> $request->get('fk_customer_id'),
            'fk_user_id' => $request->get('fk_user_id'), 
            'fk_item_id'=> $request->get('fk_item_id'),
            'fk_in_id' => $request->get('fk_in_id'),
            'fk_ex_id' => $request->get('fk_ex_id'),
            'fk_prefix_id' => $request->get('fk_prefix_id')
        ]);

        $Quote->save();
        return back()->with('success', 'Quote added');    
    }

}
