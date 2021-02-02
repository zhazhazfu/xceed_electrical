<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;

class HistoryController extends Controller
{
    public function index(Request $request)
    {   
        $pageHeading = 'History';
        $quotes = Quote::all();
        
        return view('history', compact('pageHeading', 'quotes'));
    }

    public function edit($quote_id)
    {
        $pageHeading = 'Quote Status and Comment';
        $quotesid = Quote::find($quote_id);
        $quotes = Quote::all();

        return view('editlayouts.quoteedit', compact('quotesid', 'quotes', 'pageHeading'));
    }

    public function update(Request $request, $quote_id)
    {

        $this->validate($request,[
            'quote_status' => 'required',
            'quote_comment' => 'required',
            'quote_archived' => 'required',
        ]);

        $quotes = Quote::find($quote_id);
        $quotes->quote_status = $request->get('quote_status');
        $quotes->quote_comment = $request->get('quote_comment');
        $quotes->quote_archived = $request->get('quote_archived');
        $quotes->save();

        return redirect('/history')->with('success', 'Product updated');
    }


}

