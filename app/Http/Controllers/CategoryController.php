<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $pageHeading = 'Category Management';
        $categories = Category::all();
        $subcategories = SubCategory::all();
  
        return view('categories', compact('pageHeading', 'categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required'
        ]);

        $newCategory = new Category([
            'category_name' => $request->get('category_name'),
            'category_archived' => $request->get('category_archived')
        ]);
        
        $newCategory->save();
        return back()->with('success', 'Category added');
    }

    public function show($pk_category_id)
    {

        $categories = Category::find($pk_category_id);
        $subcategories = $categories->subCategories;
        $pageHeading = 'Category Management';
  
        return view('categories', compact('pageHeading', 'categories', 'subcategories'));
    }

    public function edit($pk_category_id)
    {
        $pageHeading = 'Edit Category';
        $categories = Category::find($pk_category_id);

        return view('editlayouts.categoryedit', compact('categories', 'pk_category_id', 'pageHeading'));
    }

    public function update(Request $request, $pk_category_id)
    {
        $this->validate($request, [
            'category_name' => 'required'
        ]);

        $categories = Category::find($pk_category_id);
        $categories->category_name = $request->get('category_name');
        $categories->category_archived = $request->get('category_archived');
        $categories->save();

        return redirect()->route('categories.index')->with('success', 'Category updated');
    }

}
