<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\GrossMargin;
use App\CompanyCost;
use App\EmployeeCost;
use App\Customer;
class AdmindashController extends Controller
{
    public function index()
    {
        //
        $pageHeading = 'Admin Dash';

        return view('admindash',[
            'pageHeading' => $pageHeading]);
    }
}
