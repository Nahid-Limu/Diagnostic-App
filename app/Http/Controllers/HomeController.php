<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Test;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function autoSearch(Request $request)
    {
        
        if ($request->search) {
            $ids = explode(",", $request->SearchedTestIds);
            $search = $request->search;
            $tests = Test::where('test_name','LIKE',"%{$search}%")->whereNotIn('id', $ids)->get();
            //dd($users);
            $output = '<ul>';
            foreach ($tests as $test) {
                $output .='<li id='.$test->id.'>'.$test->test_name.'</li>';
            }
            $output .='</ul>';
            
            if (count($tests)>0) {
                return $output;
            } else {
                return  $output = '<ul><li style=" color:red;">No Data Found or Already Used</li></ul>';
            }
            
            // return $output;
        }
    }

    public function getTable(Request $request)
    {
        $no = $request->i - 1;
        $test = Test::find($request->data);
        $no;
        $output = '';

        $output .= '<tr id=test'.$test->id.'>
        <td >'.$no.'</td>
        <td>'.$test->test_name.'</td>
        <td>'.$test->test_code.'</td>
        <td class ="price">'.$test->test_price.'</td>
        <td class ="testaction" onclick="removeRow(\'test\'+'.$test->id.')"><i class="fa fa-remove" style="font-size:24px; color:red;"></i></td>';
        
        $output .='</tr>';
        $no++;
        $tid = $test->id;

        return response()->json([
            'output' => $output,
            'tid' => $tid
        ]);
    }

    public function insert()
    {
        return view('insert');
    }

    public function test()
    {
        return 121;
    }

    

    

}
