<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Test;
use App\Clint;
use App\Invoice;
use App\Discount;
use DB;

class ClintController extends Controller
{
    public function ClintReg(Request $request)
    {
        $ThisYear = date("Y");

        if ($request->has('exist_clint_id')) {

            $Clint = Clint::find($request->exist_clint_id);
            $update_age = $ThisYear - $Clint->clint_birth_year;

            $Clint->clint_name = $request->clint_name;
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
            $Invoice->invoice_id = $invoice_id;
            $Invoice->user_id = Auth::user()->id;
            $Invoice->clint_id = $Clint->id;
            $Invoice->test_id = $test_id;
            $Invoice->test_price = $TestPrice;
            $Invoice->ref_dr = $request->ref_dr;
            $Invoice->save();
        }

        $Discount = new Discount;
        $Discount->discount_amount = $request->discount_amount;
        $Discount->invoice_id = $invoice_id;
        $Discount->clint_id = $Clint->id;
        $Discount->user_id = Auth::user()->id;
        $Discount->save();

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
        $User = User::find($lastInvoice->user_id);
        $data =  $request->t_data;

        $TotalAmount = Invoice::where('invoice_id',$lastInvoice->invoice_id)->sum('test_price');
        $Discount = Discount::where('invoice_id',$lastInvoice->invoice_id)->sum('discount_amount');
        
        $netAmountInWord =$this->convert_number_to_words($TotalAmount - $Discount);
        // dd($netAmountInWord);
        return view('print', compact('Clint','lastInvoice','User','netAmountInWord','data'));
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

    ///

    private function convert_number_to_words($number) {
   
        $hyphen      = '-';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'Zero',
            1                   => 'One',
            2                   => 'Two',
            3                   => 'Three',
            4                   => 'Four',
            5                   => 'Five',
            6                   => 'Six',
            7                   => 'Seven',
            8                   => 'Eight',
            9                   => 'Nine',
            10                  => 'Ten',
            11                  => 'Eleven',
            12                  => 'Twelve',
            13                  => 'Thirteen',
            14                  => 'Fourteen',
            15                  => 'Fifteen',
            16                  => 'Sixteen',
            17                  => 'Seventeen',
            18                  => 'Eighteen',
            19                  => 'Nineteen',
            20                  => 'Twenty',
            30                  => 'Thirty',
            40                  => 'Fourty',
            50                  => 'Fifty',
            60                  => 'Sixty',
            70                  => 'Seventy',
            80                  => 'Eighty',
            90                  => 'Ninety',
            100                 => 'Hundred',
            1000                => 'Thousand',
            1000000             => 'Million',
            1000000000          => 'Billion',
            1000000000000       => 'Trillion',
            1000000000000000    => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
        );
       
        if (!is_numeric($number)) {
            return false;
        }
       
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
     
        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }
       
        $string = $fraction = null;
       
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
       
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }
       
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
       
        return $string;
    }

    ///
}
