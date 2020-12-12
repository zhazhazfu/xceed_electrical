<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PriceList;
use App\Material;
use App\Category;
use App\SubCategory;
use App\GrossMargin;
use App\CompanyCost;
use App\EmployeeCost;

class PriceListController extends Controller
{
    public function index()
    {   
        $pageHeading = 'Price List';
        $priceLists = PriceList::all();
        $materials = Material::all();
        $subCategories = SubCategory::all();
        $grossMargins = GrossMargin::all();
  
        return view('pricelists', compact('pageHeading', 'priceLists', 'category', 'materials', 'subCategories', 'grossMargins'));
    }

    public function show($id="")
    {
        $pageHeading = 'Price List';
        $category = Category::find($id);
        $materials = Material::all();
        $subCategories = $category->subCategories;
        $categoryName = $category->category_name;
        $grossMargins = GrossMargin::all();
        $companyCosts = CompanyCost::all();
        $employeeCosts = EmployeeCost::all();
        $page_id = $id;
        return view('pricelists', compact('pageHeading', 'materials', 'subCategories', 'categoryName', 'page_id', 'grossMargins', 'companyCosts', 'employeeCosts'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'item_number' => 'required',
            'item_jobtype' => 'required',
            'fk_subcategory_id' => 'required',
            'item_description' => 'required',
            'fk_material_id' => 'required',
            'item_estimatedtime' => 'required',
            'item_servicecall' => 'required',
        ]);

        $priceLists = new PriceList([
            'item_number' => $request->get('item_number'),
            'item_jobtype' => $request->get('item_jobtype'),
            'fk_subcategory_id'	=> $request->get('fk_subcategory_id'),
            'item_description' => $request->get('item_description'), 
            'fk_material_id' => $request->get('fk_material_id'),
            'item_estimatedtime' => $request->get('item_estimatedtime'),
            'item_servicecall' => $request->get('item_servicecall'),
            'item_archived' => $request->get('item_archived')
        ]);

        $priceLists->save();
        return back()->with('success', 'Product added');    
    }

    public function edit($page_id, $pk_item_id)
    {
        $pageHeading = 'Price List';
        $priceLists = PriceList::find($pk_item_id);
        $subCategories = SubCategory::all();
        $materials = Material::all();

        return view('editlayouts.pricelistedit', compact('priceLists', 'pk_item_id', 'pageHeading', 'subCategories', 'materials', 'page_id'));
    }

    public function update(Request $request, $page_id, $pk_item_id)
    {

        $this->validate($request,[
            'item_number' => 'required',
            'item_jobtype' => 'required',
            'fk_subcategory_id' => 'required',
            'item_description' => 'required',
            'fk_material_id' => 'required',
            'item_estimatedtime' => 'required',
            'item_servicecall' => 'required',
        ]);
        
        $priceLists = PriceList::find($pk_item_id);
        $priceLists->item_number = $request->get('item_number');
        $priceLists->item_jobtype = $request->get('item_jobtype');
        $priceLists->fk_subcategory_id = $request->get('fk_subcategory_id');
        $priceLists->item_description = $request->get('item_description');
        $priceLists->fk_material_id = $request->get('fk_material_id');
        $priceLists->item_estimatedtime = $request->get('item_estimatedtime');
        $priceLists->item_servicecall = $request->get('item_servicecall');
        $priceLists->item_archived = $request->get('item_archived');
        $priceLists->save();

        return redirect('/pricelists/'.$page_id)->with('success', 'Product updated');
    }
    
}
