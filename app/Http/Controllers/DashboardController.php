<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\GrossMargin;
use App\CompanyCost;
use App\EmployeeCost;
use App\Customer;
class DashboardController extends Controller
{
    public function index()
    {
        //
        $pageHeading = 'Dashboard';
        $grossmargin = GrossMargin::all();
        $employeeCosts = EmployeeCost::all();
        $companyCosts = CompanyCost::all();
        $customers = Customer::all();
        $result = DB::table('companycosts')->where('companycost_archived', '0')
            ->select(
                DB::raw('companycost_name as companycost_name'),
                DB::raw('companycost_yearly as companycost_yearly'),
            )
            ->get();

        $array[] = ['companycost_name', 'companycost_yearly'];
        foreach ($result as $key => $value) {
            $array[++$key] = [$value->companycost_name, $value->companycost_yearly];
        }


        //

        return view('dashboard',[
            'pageHeading' => $pageHeading,
            'grossmargin'=> $grossmargin,
            'employeeCosts'=> $employeeCosts,
            'companyCosts'=> $companyCosts,
            'customers'=>$customers,
            'companycost_name'=>json_encode($array)]);
    }
}
