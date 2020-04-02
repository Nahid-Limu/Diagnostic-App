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

    public function insert()
    {
        return view('insert');
    }
    
    public function print(Request $request)
    {
        $data =  $request->t_data;
        
        //return view('print', compact(['data']));
        return view('print')->with('data', $data);
    }

    public function insertPost(Request $request)
    {
        $test = new Test;

        $test->test_name = $request->name;
        $test->test_code = "101";
        $test->test_price = 200;
        
        $test->save();
    }

    public function autoSearch(Request $request)
    {
        // $search = $request->search;
        // $tests = Test::where('test_name','LIKE',"%{$search}%")->pluck('test_name');
        // return $tests;

        if ($request->search) {
            
            $search = $request->search;

            $tests = Test::where('test_name','LIKE',"%{$search}%")->get();
            //dd($users);
            $output = '<ul>';
            
            
            foreach ($tests as $test) {
                $output .='<li>'.$test->test_name.'</li>';
            }
            $output .='</ul>';	
        
            return $output;
        
         }
    }

    public function getTable(Request $request)
    {
        
        $data = $request->data;
        $no = $request->i - 1;
        $tests = Test::Where('test_name', 'LIKE',"%{$data}%")->get();
        $output = '';

         foreach ($tests as $test) {
            $no;
            $output .= '<tr id=test'.$test->id.'>
            <td >'.$no.'</td>
            <td>'.$test->test_name.'</td>
            <td>'.$test->test_code.'</td>
            <td class ="price">'.$test->test_price.'</td>
            <td onclick="removeRow(\'test\'+'.$test->id.')"><i class="fa fa-remove" style="font-size:24px; color:red;"></i></td>';
          $no++;
        }
        $output .='</tr>';

        return $output;
        
    }

}
