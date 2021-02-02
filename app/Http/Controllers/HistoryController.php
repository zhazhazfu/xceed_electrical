<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
/*use App\Perpointquote;*/

class HistoryController extends Controller
{
    public function index(Request $request)
    {   
       $pageHeading = 'History';
        /*$tmp_perpoint = Perpointquote::get();
        $tmp_quotes = Quote::get();*/
       /* $tmp_perpoint = Quote::where('quote_status','!=',3)->get();*/
        $tmp_quotes = Quote::where('quote_status','!=',1)->get();

/*
        foreach($tmp_perpoint as $key => $data)
        {
            $data->type = 'Per Point Quote';
            $data->desc = Category::where('pk_category_id',SubCategory::where('pk_subcategory_id',Items::where('pk_item_id', QuoteHasItem::where('fk_quote_id',Perpointquote::first()->pk_quote_id)->first()->fk_item_id)->first()->fk_subcategory_id )->first()->fk_category_id)->first()->category_name;
        }*/
        foreach($tmp_quotes as $key => $data)
        {
            $data->type = 'Fixed Quote';
           /* $data->desc = Category::where('pk_category_id',SubCategory::where('pk_subcategory_id',Items::where('pk_item_id', QuoteHasItem::where('fk_quote_id',Quote::first()->pk_quote_id)->first()->fk_item_id)->first()->fk_subcategory_id )->first()->fk_category_id)->first()->category_name;*/
        }
       // $quotes = $tmp_quotes->merge($tmp_perpoint);
        $quotes = $tmp_quotes;

        return view('history',['pageHeading' => $pageHeading])->with(['quotes'=>$quotes]);
        
        //return view('history', compact('pageHeading', 'quotes'));
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

