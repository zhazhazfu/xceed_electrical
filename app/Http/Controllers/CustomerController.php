<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Discount;

class CustomerController extends Controller
{

    public function index()
    {
        $pageHeading = 'Customers';
        $customers = Customer::all();
        $discounts = Discount::all();
        
        return view('customers', compact('pageHeading', 'customers', 'discounts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_name' => 'required'
        ]);
        
        $newCustomer = new Customer([
            'customer_name' => $request->get('customer_name'),
            'customer_company' => $request->get('customer_company'),
            'customer_phone' => $request->get('customer_phone'),
            'customer_email' => $request->get('customer_email'),
            'customer_address' => $request->get('customer_address'),
            'fk_discount_id' => $request->get('customer_discount'),
            'customer_archived' => $request->get('customer_archived')
        ]);
        
        $newCustomer->save();
        return back()->with('success', 'Customer added');
    }

    public function edit($pk_customer_id)
    {
        $pageHeading = 'Customers';
        $customers = Customer::find($pk_customer_id);
        $discounts = Discount::all();

        return view('editlayouts.customeredit', compact('customers', 'pk_customer_id', 'pageHeading', 'discounts'));
    }

    public function update(Request $request, $pk_customer_id)
    {

        $this->validate($request,[
                    'customer_name' => 'required',
                ]);
        
        $customers = Customer::find($pk_customer_id);
        $customers->customer_name = $request->get('customer_name');
        $customers->customer_company = $request->get('customer_company');
        $customers->customer_phone = $request->get('customer_phone');
        $customers->customer_email = $request->get('customer_email');
        $customers->customer_address = $request->get('customer_address');
        $customers->fk_discount_id = $request->get('customer_discount');
        $customers->customer_archived = $request->get('customer_archived');
        $customers->save();

        return redirect()->route('customers.index')->with('success', 'Customer updated');
    }
    
}
