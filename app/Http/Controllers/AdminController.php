<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Test;
use App\Clint;
use App\Invoice;

class AdminController extends Controller
{
    public function dashbord()
    {
        $ThisYear = date("Y");
        $ThisMonth = date("m");
        $ThisDay = date("Y-m-d");
        
        $MonthlyIncome = Invoice::whereMonth('created_at', $ThisMonth)->sum('test_price');
        $YearlyIncome = Invoice::whereYear('created_at', $ThisYear)->sum('test_price');
        $ToatalInvoice = Invoice::all()->Count();
        $ToatalClint = Clint::all()->Count();

        $ToDaysInvoice = Invoice::whereDate('created_at', $ThisDay)->get()->Count();
        $ThisMonthsInvoice = Invoice::whereMonth('created_at', $ThisMonth)->get()->Count();
        $ThisYearsInvoice = Invoice::whereYear('created_at', $ThisYear)->get()->Count();

        $DailyIncome = Invoice::whereDate('created_at', $ThisDay)->sum('test_price');
        $MonthlyIncome = Invoice::whereMonth('created_at', $ThisMonth)->sum('test_price');
        $YearlyIncome = Invoice::whereYear('created_at', $ThisYear)->sum('test_price');
        // dd($ThisYearsInvoice);
        return view('admin.dashbord', compact('MonthlyIncome','YearlyIncome','ToatalInvoice','ToatalClint','ToDaysInvoice','ThisMonthsInvoice','ThisYearsInvoice','DailyIncome','MonthlyIncome','YearlyIncome'));
    }
}
