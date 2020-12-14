<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\GrossMargin;
use App\CompanyCost;
use App\EmployeeCost;
use App\Customer;
class ResetpasswordController extends Controller
{
    public function index()
    {
        //
        $pageHeading = 'Reset Password - Enter your new password';

        return view('resetpassword',[
            'pageHeading' => $pageHeading]);
    }
}
