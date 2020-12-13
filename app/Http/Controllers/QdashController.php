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

class QdashController extends Controller
{
    public function index()
    {   
        $pageHeading = 'Quote dashboard';
        
  
        return view('qdash',[
            'pageHeading' => $pageHeading]); 
    }

   
        
    
}
