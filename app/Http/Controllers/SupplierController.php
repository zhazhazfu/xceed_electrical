<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    public function index()
    
    {
        $pageHeading = 'Suppliers';

        $suppliers = Supplier::all();

        return view('suppliers', compact('pageHeading', 'suppliers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_companyname' => 'required',
        ]);

        $newSupplier = new Supplier([
            'supplier_companyname' => $request->get('supplier_companyname'),
            'supplier_contactname' => $request->get('supplier_contactname'),
            'supplier_phone' => $request->get('supplier_phone'),
            'supplier_email' => $request->get('supplier_email'),
            'supplier_archived' => $request->get('supplier_archived')
        ]);
        $newSupplier->save();
        return back()->with('success', 'Supplier added');
    }

    public function edit($pk_supplier_id)
    {
        $pageHeading = 'Suppliers';
        $suppliers = Supplier::find($pk_supplier_id);


        return view('editlayouts.supplieredit', compact('suppliers', 'pk_supplier_id', 'pageHeading'));
    }

    public function update(Request $request, $pk_supplier_id)
    {

        $this->validate($request, [
            'supplier_companyname' => 'required',
        ]);
        
        $suppliers = Supplier::find($pk_supplier_id);
        $suppliers->supplier_companyname = $request->get('supplier_companyname');
        $suppliers->supplier_contactname = $request->get('supplier_contactname');
        $suppliers->supplier_phone = $request->get('supplier_phone');
        $suppliers->supplier_email = $request->get('supplier_email');
        $suppliers->supplier_archived = $request->get('supplier_archived');
        $suppliers->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated');
    }

}
