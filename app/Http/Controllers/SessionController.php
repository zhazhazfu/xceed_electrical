<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quote;


class SessionController extends Controller
{
    public function accessSessionData(Request $request) {
        if($request->session()->has('customer_name','itemNo','quote_number','subcategorySelect','item_number','item_description','ex_name','in_name','term_name'))
           echo $request->session()->get('quote_number');
        else
           echo 'No data in the session';
     }
     public function storeSessionData(Request $request) {
        $request->session()->put('customer_name','itemNo','quote_number','subcategorySelect','item_number','item_description','ex_name','in_name','term_name');
        echo "Data has been added to session";
     }
     public function deleteSessionData(Request $request) {
        $request->session()->forget('customer_name','itemNo','quote_number','subcategorySelect','item_number','item_description','ex_name','in_name','term_name');
        echo "Data has been removed from session.";
     }
}
