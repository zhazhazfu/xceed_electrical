<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Items;
use App\Material;
use App\Category;
use App\SubCategory;


class AddItemController extends Controller
{
    public function index()
    {   
        $pageHeading = 'Job List';
        $items = Items::all();
        $category = Category::all();
        $materials = Material::all();
        $subCategories = SubCategory::all();
         
        return view('addItem', compact('pageHeading', 'items', 'category', 'materials', 'subCategories'));
    }

    public function show($id="")
    {
        $pageHeading = 'Price List';
        $category = Category::find($id);
        $items = Items::all();
        $materials = Material::all();
        $subCategories = SubCategory::all();
        $categoryName = $category->category_name;
        $page_id = $id;
        return view('addItem', compact('pageHeading', 'materials', 'items','subCategories', 'categoryName', 'page_id'));
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
            'item_labourcost' => 'required'
        ]);


        $item = new Items([
            'item_number' => $request->get('item_number'),
            'item_jobtype' => $request->get('item_jobtype'),
            'fk_subcategory_id'	=> $request->get('fk_subcategory_id'),
            'item_description' => $request->get('item_description'), 
            'item_estimatedtime' => $request->get('item_estimatedtime'),
            'item_servicecall' => $request->get('item_servicecall'),
            'item_labourcost' => $request->get('item_labourcost'),
            'item_archived' => $request->get('item_archived')
        ]);


        $item->save();
        return back()->with('success', 'Job added');    
    }
    
}
