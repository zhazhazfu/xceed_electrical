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
    
            return view('quoting', compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'priceLists', 'quoteterms', 'discounts', 'grossmargins', 'exclusions', 'inclusions'));
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

}
