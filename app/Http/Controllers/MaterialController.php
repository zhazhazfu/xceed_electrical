<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\Supplier;

class MaterialController extends Controller
{
    public function index()
    
    {
        $pageHeading = 'Materials';

        $materials = Material::all();

        $suppliers = Supplier::all();

        return view('materials', compact('pageHeading', 'materials', 'suppliers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'material_description' => 'required',
            'material_cost' => 'required',
        ]);

        $newMaterial = new Material([
            'material_itemcode' => $request->get('material_itemcode'),
            'material_description' => $request->get('material_description'),
            'material_cost' => $request->get('material_cost'),
            'fk_supplier_id' => $request->get('fk_supplier_id'),
            'material_archived' => $request->get('material_archived')
        ]);
        $newMaterial->save();
        return back()->with('success', 'Material added');
    }

    public function edit($pk_material_id)
    {
        $pageHeading = 'Materials';
        $materials = Material::find($pk_material_id);
        $suppliers = Supplier::all();

        return view('editlayouts.materialedit', compact('materials', 'pk_material_id', 'pageHeading', 'suppliers'));
    }

    public function update(Request $request, $pk_material_id)
    {

        $this->validate($request, [
            'material_description' => 'required',
            'material_cost' => 'required',
        ]);
        
        $materials = Material::find($pk_material_id);
        $materials->material_itemcode = $request->get('material_itemcode');
        $materials->material_description = $request->get('material_description');
        $materials->material_cost = $request->get('material_cost');
        $materials->fk_supplier_id = $request->get('fk_supplier_id');
        $materials->material_archived = $request->get('material_archived');
        $materials->save();

        return redirect()->route('materials.index')->with('success', 'Material updated');
    }

}
