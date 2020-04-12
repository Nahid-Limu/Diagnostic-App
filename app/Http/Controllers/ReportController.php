<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function report()
    {
        $Report = DB::table('invoices')
            ->join('tests', 'invoices.test_id', '=', 'tests.id')
            ->select('invoices.test_id','tests.test_name' ,'tests.test_code','tests.test_price',DB::raw('count(invoices.test_id) as testquentity'), DB::raw('( count(invoices.test_id) * tests.test_price)  as TotalPrice') )
            ->groupBy('invoices.test_id','tests.test_name','tests.test_code','tests.test_price')
            ->whereDate('invoices.created_at', '2020-04-12')
            ->get();
        dd($data);
    }
}
