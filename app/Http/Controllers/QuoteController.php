<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\ItemHasMaterials;
use App\QuoteHasItem;
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
            $grossmargins = GrossMargin::all();
            $prefixes = Prefix::all();
            $companyCosts = CompanyCost::all();
            $employeeCosts = EmployeeCost::all();
    
            return view('quoting', compact('pageHeading', 'quotes', 'businessDetails', 'customers', 'categories', 'subCategories', 'items', 'quoteterms', 'discounts', 'grossmargins', 'exclusions', 'inclusions', 'companyCosts', 'employeeCosts', 'prefixes'));
        }

    // public function show($id="")
    // {
    //     $pageHeading = 'Quoting';
    //     $category = Category::find($id);
    //     $subCategories = $category->subCategories;
    //     $categoryName = $category->category_name;
  
    //     return view('quoting', compact('pageHeading', 'subCategories', 'categoryName'));
    // }

    public function store(Request $request) 
    {
        
        $this->validate($request, [
            'customer_name' => 'required',
            'quote_prefix' => 'required',
            'item_number' => 'required',
            'term_name' => 'required',
            'inc_name' => 'required',
            'exc_name' => 'required',
            'item_price' =>'required',
            'price' => 'required',
            'gst_price' => 'required'
        ]);
        
        $business = BusinessDetail::where('businessdetail_email','info@xceedelectrical.com.au')->first();
        $quote = new Quote;
        $quote->fk_businessdetail_id = $business->pk_businessdetail_id;
        $quote->fk_customer_id = $request->get('customer_name');
        $quote->fk_user_id = Auth::user()->pk_user_id;
        $quote->fk_term_id = $request->get('term_name'); 
        $quote->inclusions = $request->get('inc_name');
        $quote->exclusions = $request->get('exc_name');
        $quote->fk_prefix_id = $request->get('quote_prefix');
        $quote->quote_number = $request->get('quote_number');
        $quote->quote_status = $request->get('quote_status');
        $quote->quote_status = 2;
        $quote->quote_comment = $request->get('quote_comment');
        $quote->save();

        foreach ($request->get('item_number') as $key => $value) {
            $QuoteHasItem = new QuoteHasItem();
            $QuoteHasItem->fk_quote_id = $quote->pk_quote_id;
            $QuoteHasItem->fk_item_id = $value;
            $QuoteHasItem->item_price =$request->get('item_price');
            $QuoteHasItem->price = $request->get('price');
            $QuoteHasItem->GST_price = $request->get('gst_price');
            $QuoteHasItem->save();
        }

        return redirect('/history/')->with('success', 'Quote Added');
    }

    public function quotestatus(Request $request)
    {
        $quote = Quote::where('pk_quote_id',$request->get('id'))->first();
        $quote->quote_status = $request->value;
        $quote->quote_comment = $request->comment;
        $quote->save();

        
        return response()->json(true);
    }
    public function getSubcategories($id="")
    {
        $sCatNames = array();
        $sCatIDs = array();
        $result = SubCategory::where('fk_category_id', '=', $id)->get()->toArray();
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
        $item = Items::where('pk_item_id', '=', $id)->first();
      

        $companyCosts = CompanyCost::all();
        $employeeCosts = EmployeeCost::all();
        //--------------------------total company expenses-----------------------------------
        $total = 0;
        foreach ($companyCosts as $companyCost) {
            if($companyCost->companycost_archived == '0')
            {
                $total += $companyCost->companycost_yearly;
            }
        }
        //--------------------------------------------------------------
        //--------------------------total employee costs-----------------------------------
        $total_employee = 0;
        $total_cost_less_super=0;
        foreach ($employeeCosts as $employeeCost) {
            if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Employee')
            {
                $total_employee += $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
                $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
                $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;

                $total_cost_less_super+=$employeeCost->employee_workercomp +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
                +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
            }
        }
        //--------------------------------------------------------------
        //--------------------------total sub-contractor costs-----------------------------------
        $total_subcontractor = 0;
        $total_cost_less_super=0;
        foreach ($employeeCosts as $employeeCost) {
            if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Sub-Contractor')
            {
                $total_subcontractor += $employeeCost->employee_cash + $employeeCost->employee_workercomp +
                $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
                $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
                $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;

                $total_cost_less_super+=$employeeCost->employee_workercomp +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
                +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
            }
        }
        //--------------------------------------------------------------
        $total_business_hourly_cost = $total + $total_employee + $total_subcontractor;
        $grossMargin = GrossMargin::get()->last();

        $temp_mat_cost = 0;
        foreach ($item->itemHasMaterials as $temp_itemHasMaterial)
        {
            $temp_mat_cost += $temp_itemHasMaterial->material->material_cost*$temp_itemHasMaterial->quantity;
        }
        $price = number_format((($temp_mat_cost*$grossMargin->gm_rate) + $item->item_servicecall + $item->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8))*1.1,2);

        return response()->json(['price' => $price]);
    }

    // public function total_pricings(Request $request)
    // {
    //     $companyCosts = CompanyCost::all();
    //     $employeeCosts = EmployeeCost::all();
    //     //--------------------------total company expenses-----------------------------------
    //     $total = 0;
    //     foreach ($companyCosts as $companyCost) {
    //         if($companyCost->companycost_archived == '0')
    //         {
    //             $total += $companyCost->companycost_yearly;
    //         }
    //     }
    //     //--------------------------------------------------------------
    //     //--------------------------total employee costs-----------------------------------
    //     $total_employee = 0;
    //     $total_cost_less_super=0;
    //     foreach ($employeeCosts as $employeeCost) {
    //         if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Employee')
    //         {
    //             $total_employee += $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek*
    //             $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
    //             $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
    //             $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
    //             $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;

    //             $total_cost_less_super+=$employeeCost->employee_workercomp +
    //             $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
    //             $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
    //             +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
    //             $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
    //             $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
    //             $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
    //         }
    //     }
    //     //--------------------------------------------------------------
    //     //--------------------------total sub-contractor costs-----------------------------------
    //     $total_subcontractor = 0;
    //     $total_cost_less_super=0;
    //     foreach ($employeeCosts as $employeeCost) {
    //         if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Sub-Contractor')
    //         {
    //             $total_subcontractor += $employeeCost->employee_cash + $employeeCost->employee_workercomp +
    //             $employeeCost->employee_hoursperweek*
    //             $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
    //             $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
    //             $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
    //             $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;

    //             $total_cost_less_super+=$employeeCost->employee_workercomp +
    //             $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
    //             $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
    //             +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
    //             $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
    //             $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
    //             $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
    //         }
    //     }
    //             $total_business_hourly_cost = $total + $total_employee + $total_subcontractor;
    // }

    public function quote_pricings(Request $request)
    {
            
        $final_price = 0;
        $final_gst = 0;
        $companyCosts = CompanyCost::all();
        $employeeCosts = EmployeeCost::all();
        //--------------------------total company expenses-----------------------------------
        $total = 0;
        foreach ($companyCosts as $companyCost) {
            if($companyCost->companycost_archived == '0')
            {
                $total += $companyCost->companycost_yearly;
            }
        }
        //--------------------------------------------------------------
        //--------------------------total employee costs-----------------------------------
        $total_employee = 0;
        $total_cost_less_super=0;
        foreach ($employeeCosts as $employeeCost) {
            if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Employee')
            {
                $total_employee += $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
                $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
                $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;

                $total_cost_less_super+=$employeeCost->employee_workercomp +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
                +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
            }
        }
        //--------------------------------------------------------------
        //--------------------------total sub-contractor costs-----------------------------------
        $total_subcontractor = 0;
        $total_cost_less_super=0;
        foreach ($employeeCosts as $employeeCost) {
            if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Sub-Contractor')
            {
                $total_subcontractor += $employeeCost->employee_cash + $employeeCost->employee_workercomp +
                $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
                $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
                $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;

                $total_cost_less_super+=$employeeCost->employee_workercomp +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
                +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
            }
        }
        //--------------------------------------------------------------
        $total_business_hourly_cost = $total + $total_employee + $total_subcontractor;
        $grossMargin = GrossMargin::get()->last();

        foreach ($request->id_values as $key => $id) {
            $item = Items::where('pk_item_id', '=', $id)->first();
            if ($item) {
                $temp_mat_cost = 0;
                foreach ($item->itemHasMaterials as $temp_itemHasMaterial)
                {
                    $temp_mat_cost += $temp_itemHasMaterial->material->material_cost*$temp_itemHasMaterial->quantity;
                }
                $final_price += number_format(($temp_mat_cost*$grossMargin->gm_rate) + $item->item_servicecall + $item->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8),2);  

                $final_gst += number_format((($temp_mat_cost*$grossMargin->gm_rate) + $item->item_servicecall + $item->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8))*1.1,2);                  
            }
        }
        return response()->json(compact('final_price' , 'final_gst'));
    }
}
