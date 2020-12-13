<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PriceList;
use App\Material;
use App\Category;
use App\SubCategory;
use App\GrossMargin;
use App\CompanyCost;
use App\EmployeeCost;

class PerpointController extends Controller
{
    public function index()
    {   
        $pageHeading = 'Perpoint Quote';
        
  
        return view('perpointquote',[
            'pageHeading' => $pageHeading]); 
    }

   
        
    
}
