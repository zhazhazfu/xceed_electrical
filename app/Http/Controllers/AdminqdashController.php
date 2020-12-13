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

class AdminqdashController extends Controller
{
    public function index()
    {   
        $pageHeading = 'Admin Quote dashboard';
        
  
        return view('adminqdash',[
            'pageHeading' => $pageHeading]); 
    }

   
        
    
}
