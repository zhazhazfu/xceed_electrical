<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuoteTerm;

class QuoteTermController extends Controller
{
    public function index()
    
    {
        $quoteterms = QuoteTerm::all();


        return view('quoteterms', compact('quoteterms'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'term_name' => 'required',
            'term_body' => 'required',
            'term_archived' => 'required'
        ]);

        $newQuoteTerm = new QuoteTerm([
            'term_name' => $request->get('term_name'),
            'term_body' => $request->get('term_body'),
            'term_archived' => $request->get('term_archived')
        ]);
        $newQuoteTerm->save();
        return back()->with('success', 'Quote terms added');
    }

    public function edit($pk_term_id)
    {
        $quoteterms = QuoteTerm::find($pk_term_id);

        return view('editlayouts.quotetermedit', compact('quoteterms', 'pk_term_id'));
    }

    public function update(Request $request, $pk_term_id)
    {

        $this->validate($request,[
                'term_name' => 'required',
                'term_body' => 'required',
                'term_archived' => 'required'
            ]);

        $quoteterms = QuoteTerm::find($pk_term_id);
        $quoteterms->term_name = $request->get('term_name');
        $quoteterms->term_body = $request->get('term_body');
        $quoteterms->term_archived = $request->get('term_archived');
        $quoteterms->save();

        return redirect()->route('quoteterms.index')->with('success', 'Quote term updated');
    }
}
