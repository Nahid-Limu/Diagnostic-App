<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Test;
use DB;

class ClintController extends Controller
{
    public function ClintReg(Request $request)
    {
        dd( $request->all() );
         // $testIds = explode(",", $request->testIds);
        // dd(json_encode($testIds));
        // dd(json_decode(json_encode($testIds)));
        $testIds = $request->testIds;
        $data =  $request->t_data;
        
        return view('print', compact('data','testIds'));
        // return view('print')->with('data', $data);
    }
}
