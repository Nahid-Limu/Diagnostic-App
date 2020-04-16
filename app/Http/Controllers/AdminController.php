<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Test;
use App\Clint;
use App\Invoice;
use App\DailyExpense;
use App\Discount;
use DB;

class AdminController extends Controller
{
    public function dashbord()
    {
        $ThisYear = date("Y");
        $ThisMonth = date("m");
        $ThisDay = date("Y-m-d");
        
        $TotakIncome = Invoice::all()->sum('test_price');
        $TotalDiscount = Discount::all()->sum('discount_amount');
        $TotalExpense = DailyExpense::all()->sum('ammount');
        $ToatalClint = Clint::all()->Count();

        $lineChartIncome = Invoice::select(DB::raw('YEAR(created_at) year, MONTH(created_at) month'),DB::raw('SUM(test_price) as monthlyTestPrice'))
        ->groupby('year','month')
        ->get();
        


        $DailyIncome = Invoice::whereDate('created_at', $ThisDay)->sum('test_price');
        $MonthlyIncome = Invoice::whereMonth('created_at', $ThisMonth)->sum('test_price');
        $YearlyIncome = Invoice::whereYear('created_at', $ThisYear)->sum('test_price');

        $DailyExpense = DailyExpense::whereDate('created_at', $ThisDay)->sum('ammount');
        $MonthlyExpense = DailyExpense::whereMonth('created_at', $ThisMonth)->sum('ammount');
        $YearlyExpense = DailyExpense::whereYear('created_at', $ThisYear)->sum('ammount');
        
        $ToDaysInvoice = Invoice::whereDate('created_at', $ThisDay)->get()->Count();
        $ThisMonthsInvoice = Invoice::whereMonth('created_at', $ThisMonth)->get()->Count();
        $ThisYearsInvoice = Invoice::whereYear('created_at', $ThisYear)->get()->Count();
        $ToatalInvoice = Invoice::all()->Count();
        
        // dd($test);
        return view('admin.dashbord', compact('TotakIncome','TotalExpense','ToatalInvoice','ToatalClint','lineChartIncome','TotalDiscount','DailyIncome','MonthlyIncome','YearlyIncome','DailyExpense','MonthlyExpense','YearlyExpense','ToDaysInvoice','ThisMonthsInvoice','ThisYearsInvoice'));
    }
}
