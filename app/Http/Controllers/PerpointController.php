<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perpointquote;
use App\BusinessDetail;
use App\Customer;
use App\Category;
use App\SubCategory;
use App\PriceList;
use App\QuoteTerm;
use App\Discount;
use App\GrossMargin;


class PerpointController extends Controller
{
    public function index()
    {   
        $pageHeading = 'per point quote';
        $perpointquote = Perpointquote::all();
        $businessDetails = BusinessDetail::first();
        $customers = Customer::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $priceLists = PriceList::all();
        $quoteterms = QuoteTerm::all();
        $discounts = Discount::all();
        $grossmargins = GrossMargin::all();

        return view('perpointquote', compact('pageHeading', 'perpointquote', 'businessDetails', 'customers', 'categories', 'subCategories', 'priceLists', 'quoteterms', 'discounts', 'grossmargins'));
    }

   
        
    
}
