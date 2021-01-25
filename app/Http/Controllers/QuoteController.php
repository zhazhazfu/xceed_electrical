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
use App\CompanyCost;
use App\EmployeeCost;
use App\Quote_has_item;
use App\Discount;
use App\GrossMargin;
use App\ItemHasMaterials;
use Illuminate\Support\Facades\Auth;
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
            $items = Items::all();
            $quoteterms = QuoteTerm::all();
            $exclusions = Exclusions::all();
            $inclusions = Inclusions::all();
            $discounts = Discount::all();
            $grossMargins = GrossMargin::all();
            $companyCosts = CompanyCost::all();
            $employeeCosts = EmployeeCost::all();
    
            return view('quoting', compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'items', 'quoteterms', 'discounts', 'grossMargins', 'exclusions', 'inclusions', 'companyCosts', 'employeeCosts'));
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
            'customer_name' => 'required',
            'quote_number' => 'required',
            'item_number' => 'required',
            'term_name' => 'required',
        ]);

        $business = BusinessDetail::where('businessdetail_email','info@xceedelectrical.com.au')->first();
        $quote = new Quote;
        $quote->fk_businessdetail_id  = $business->pk_businessdetail_id;
        $quote->fk_customer_id  = $request->get('customer_name');
        $quote->fk_user_id  = Auth::user()->pk_user_id;
        $quote->fk_term_id  = $request->get('term_name'); 
        $quote->fk_in_id  = $request->get('in_name');
        $quote->fk_ex_id  = $request->get('ex_name');
        $quote->quote_number = $request->get('quote_number');
        $quote->quote_status = 1;
        $quote->quote_revisonnumber = 1;

        $quote->save();

        $Quote_has_item = new Quote_has_item;
        $Quote_has_item->fk_quote_id = $quote-> pk_quote_id;
        $Quote_has_item->fk_item_id = $request->get('item_number');

        $Quote_has_item->save();

        return redirect('/history');    
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

    public function calculatePrice($id="")
    {
        $result = ItemHasMaterials::where('fk_item_id', '=', $id)->first();
        $price = $result->quantity;

        return response()->json([
            'price' => $price, 
        ]);

    }

}
