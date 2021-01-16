<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PriceList;
use App\Items;
use App\ItemHasMaterials;
use App\Material;
use App\Category;
use App\SubCategory;
use App\GrossMargin;
use App\CompanyCost;
use App\EmployeeCost;

class ItemHasMaterialController extends Controller
{
    public function index()
    {   
        $pageHeading = 'Job List';
        $itemHasMaterial = ItemHasMaterials::all();
        $items = Items::all();
        $category = Category::all();
        $materials = Material::all();
        $subCategories = SubCategory::all();
        $grossMargins = GrossMargin::all();
  
        return view('pricelists', compact('pageHeading', 'itemHasMaterial', 'items', 'category', 'materials', 'subCategories', 'grossMargins'));
    }

    public function show($id="")
    {
        $pageHeading = 'Price List';
        $category = Category::find($id);
        $itemHasMaterial = ItemHasMaterials::all();
        $items = Items::all();
        $materials = Material::all();
        $subCategories = SubCategory::all();
        $categoryName = $category->category_name;
        $grossMargins = GrossMargin::all();
        $companyCosts = CompanyCost::all();
        $employeeCosts = EmployeeCost::all();
        $page_id = $id;
        return view('pricelists', compact('pageHeading', 'materials', 'itemHasMaterial', 'items','subCategories', 'categoryName', 'page_id', 'grossMargins', 'companyCosts', 'employeeCosts'));
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


        $item = new Items([
            'item_number' => $request->get('item_number'),
            'item_jobtype' => $request->get('item_jobtype'),
            'fk_subcategory_id'	=> $request->get('fk_subcategory_id'),
            'item_description' => $request->get('item_description'), 
            'item_estimatedtime' => $request->get('item_estimatedtime'),
            'item_servicecall' => $request->get('item_servicecall'),
            'item_archived' => $request->get('item_archived')
        ]);
        $item->save(); // save the item to get a new id

        
        $itemHasMaterial = new itemHasMaterials([
            'fk_item_id' => $item-> pk_item_id, // the new id is now available to store
            'fk_material_id' => $request->get('fk_material_id')
        ]);
        $itemHasMaterial->save();
        return back()->with('success', 'Job added');    
    }

    public function edit($page_id, $pk_item_has_materails_id)
    {
        $pageHeading = 'Price List';
        $itemHasMaterialID = ItemHasMaterials::find($pk_item_has_materails_id);
        $itemHasMaterial = ItemHasMaterials::all();
        $item = Items::all();
        $subCategories = SubCategory::all();
        $materials = Material::all();

        return view('editlayouts.pricelistedit', compact('item', 'itemHasMaterialID', 'itemHasMaterial', 'pk_item_has_materails_id', 'pageHeading', 'subCategories', 'materials', 'page_id'));
    }

    public function update(Request $request, $page_id, $pk_item_has_materails_id)
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
        
        $itemHasMaterial = ItemHasMaterials::find($pk_item_has_materails_id);
        $item = Items::all();
        $item->item_number = $request->get('item_number');
        $item->item_jobtype = $request->get('item_jobtype');
        $item->fk_subcategory_id = $request->get('fk_subcategory_id');
        $item->item_description = $request->get('item_description');
        $item->item_estimatedtime = $request->get('item_estimatedtime');
        $item->item_servicecall = $request->get('item_servicecall');
        $item->item_archived = $request->get('item_archived');
        $item->save();

        $itemHasMaterial->fk_material_id = $request->get('fk_material_id');
        $itemHasMaterial->save();

        return redirect('/pricelists/'.$page_id)->with('success', 'Product updated');
    }
    
}
