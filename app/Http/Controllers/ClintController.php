<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Test;
use App\Clint;
use App\Invoice;
use DB;

class ClintController extends Controller
{
    public function ClintReg(Request $request)
    {
        $ThisYear = date("Y");

        if ($request->has('exist_clint_id')) {

            $Clint = Clint::find($request->exist_clint_id);
            $update_age = $ThisYear - $Clint->clint_birth_year;

            $Clint->clint_age = $update_age;
            $Clint->clint_tel = $request->clint_tel;
            $Clint->clint_address = $request->clint_address;
            $Clint->save();
            
        }else {

            $clint_birth_year = $ThisYear - $request->clint_age;

            $Clint = new Clint;
            $Clint->clint_name = $request->clint_name;
            $Clint->clint_age = $request->clint_age;
            $Clint->clint_birth_year = $clint_birth_year;
            $Clint->clint_sex = $request->clint_sex;
            $Clint->clint_tel = $request->clint_tel;
            $Clint->clint_address = $request->clint_address;
            $Clint->save();
        }

        $test_ids = explode(",", $request->test_ids);
        $invoice_id = Invoice::count() + 1;

        foreach ($test_ids as $key => $test_id) {
            
            $TestPrice = Test::find($test_id)->test_price;
            

            $Invoice = new Invoice;
            $Invoice->invoice_id = 'INVOICE-'.$invoice_id;
            $Invoice->user_id = Auth::user()->id;
            $Invoice->clint_id = $Clint->id;
            $Invoice->test_id = $test_id;
            $Invoice->test_price = $TestPrice;
            $Invoice->ref_dr = $request->ref_dr;
            $Invoice->save();
        }

        // $Invoice = new Invoice;
        // $Invoice->user_id = Auth::user()->id;
        // $Invoice->clint_id = $Clint->id;
        // $Invoice->test_ids = $request->test_ids;
        // $Invoice->test_price = $request->test_price;
        // $Invoice->ref_dr = $request->ref_dr;
        // $Invoice->save();

        return response()->json( ['InvoiceID' => $Invoice->id] );
    }

    public function print(Request $request)
    {
        $lastInvoice = Invoice::find($request->InvoiceID);
        $Clint = Clint::find($lastInvoice->clint_id);
        $data =  $request->t_data;
        return view('print', compact('Clint','lastInvoice','data'));
    }

    public function autocompleteClint(Request $request)
    {
        // $data = Clint::find($request->ClintID);
        $data = ($request->searchOption) == 'phone' ? Clint::where('clint_tel' , $request->ClintID)->first() : Clint::find($request->ClintID) ;
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(0);
        }
        
        
    }
}
