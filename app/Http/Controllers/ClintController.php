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
        $Clint = new Clint;
        $Clint->clint_name = $request->clint_name;
        $Clint->clint_age = $request->clint_age;
        $Clint->clint_sex = $request->clint_sex;
        $Clint->clint_tel = $request->clint_tel;
        $Clint->clint_address = $request->clint_address;
        $Clint->ref_dr = $request->ref_dr;
        $Clint->save();

        $Invoice = new Invoice;
        $Invoice->user_id = Auth::user()->id;
        $Invoice->clint_id = $Clint->id;
        $Invoice->test_ids = $request->test_ids;
        $Invoice->test_price = $request->test_price;
        $Invoice->save();

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
        // return $request->searchID;
        $data = Item::select("name")
                ->where("name","LIKE","%{$request->input('query')}%")
                ->get();
   
        return response()->json($data);
    }
}
