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
            $discounts = Discount::all();
            $grossmargins = GrossMargin::all();
    
            return view('quoting', compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'priceLists', 'quoteterms', 'discounts', 'grossmargins'));
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

        // $subCategories = json_decode(json_encode($result), true);

        // $subCatName = $subCategories->subcategory_name;
        // $subCatID = $subCategories->pk_subcategory_id;

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

}
