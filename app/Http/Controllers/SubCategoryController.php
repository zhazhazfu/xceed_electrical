<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;

class SubCategoryController extends Controller
{
    public function index()
    {
        $pageHeading = 'Category Management';

        $categories = Category::all();
        $subcategories = SubCategory::all();
  
        return view('categories', compact('pageHeading', 'subcategories', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subcategory_name' => 'required',
            'fk_category_id' => 'required'
        ]);

        $newSubCategory = new SubCategory([
            'subcategory_name' => $request->get('subcategory_name'),
            'fk_category_id' => $request->get('fk_category_id'),
            'subcategory_archived' => $request->get('subcategory_archived')
        ]);
        
        $newSubCategory->save();
        return back()->with('success', 'Sub-Category added');
    }

    public function edit($pk_subcategory_id)
    {
        $pageHeading = 'Edit Sub-Category';
        $subCategories = SubCategory::find($pk_subcategory_id);
        $categories = Category::all();

        return view('editlayouts.subcategoryedit', compact('subCategories', 'categories', 'pk_subcategory_id', 'pageHeading'));
    }

    public function update(Request $request, $pk_subcategory_id)
    {
        $this->validate($request, [
            'subcategory_name' => 'required'
        ]);

        $subCategories = SubCategory::find($pk_subcategory_id);
        $subCategories->subcategory_name = $request->get('subcategory_name');
        $subCategories->fk_category_id = $request->get('fk_category_id');
        $subCategories->subcategory_archived = $request->get('subcategory_archived');
        $subCategories->save();

        return redirect()->route('categories.index')->with('success', 'Sub-Category updated');
    }

}
