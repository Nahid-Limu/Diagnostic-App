<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\DailyExpense;
use App\Discount;
class ReportController extends Controller
{
    public function report(Request $request)
    {
        if (isset($request->from)) {
            $Reports = DB::table('invoices')
            ->join('tests', 'invoices.test_id', '=', 'tests.id')
            ->select('invoices.test_id','tests.test_name' ,'tests.test_code','tests.test_price',DB::raw('count(invoices.test_id) as testquentity'), DB::raw('( count(invoices.test_id) * tests.test_price)  as TotalPrice') )
            ->groupBy('invoices.test_id','tests.test_name','tests.test_code','tests.test_price')
            // ->whereDate('invoices.created_at', '2020-04-12')
            ->whereBetween('invoices.created_at', [$request->from, $request->to])
            ->get();
            $Discounts = Discount::whereBetween('created_at', [$request->from, $request->to])->get(['discount_amount','invoice_id']);
            // dd($Discounts);
            $no = 1;
            $dates = [
                'from' => $request->from,
                'to' => $request->to
            ];

            if (count($Reports)>0) {
                return view('admin.report', compact('Reports','Discounts','no','dates') );
            }
            
        }elseif (isset($request->btnExport)) {
            
            $Reports = DB::table('invoices')
            ->join('tests', 'invoices.test_id', '=', 'tests.id')
            ->select('tests.test_name' ,'tests.test_code','tests.test_price',DB::raw('count(invoices.test_id) as testquentity'), DB::raw('( count(invoices.test_id) * tests.test_price)  as TotalPrice') )
            ->groupBy('invoices.test_id','tests.test_name','tests.test_code','tests.test_price')
            ->whereBetween('invoices.created_at', [$request->exp_from, $request->exp_to])
            ->get();
            
            $discount = Discount::whereBetween('created_at', [$request->exp_from, $request->exp_to])->sum('discount_amount');
            $expense = DailyExpense::whereBetween('created_at', [$request->exp_from, $request->exp_to])->sum('ammount');

            $headers = ['Test Name','Test Code','Test Price','Quantity','Total'];
            $discount = ['','','DISCOUNT','=>',$discount];
            $expense = ['','','EXPENSE','=>',$expense];
            $dates = ['FROM',$request->exp_from,'','TO',$request->exp_to];
            
            // dd($Discounts);
             return $this->download($Reports,$headers, "Report-$request->exp_from-to-$request->exp_to.csv",$discount,$expense,$dates);
        }
        
        return view('admin.report');
    }

    private function download($data,$header,$filename,$discount,$expense,$dates)
    {
        
        $export = "----------------------REPORT---------------------"."\n";
        $export .= implode(",",$dates)."\n";
        $export .="----------------------------------------------------"."\n";
        $export .= implode(",",$header)."\n";

        $data = json_decode(json_encode($data), true);
        foreach($data as $key=>$val)
        {
            $export .= implode(",",$val)."\n";
        }

        $export .="----------------------------------------------------"."\n";
        $export .= implode(",",$discount)."\n";
        $export .= implode(",",$expense)."\n";
        
        $export = mb_convert_encoding($export,"SJIS", "UTF-8");
        $filename = mb_convert_encoding($filename,"SJIS", "UTF-8");
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename='.$filename);
        echo $export;
        exit();
    }
}
