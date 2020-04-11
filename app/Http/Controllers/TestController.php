<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Test;

class TestController extends Controller
{
    public function testSetting()
    {
        $Clint = Test::all(['id','test_code','test_name','test_price']);

        if(request()->ajax())
        {
            return datatables()->of($Clint)
                    
                    ->addColumn('action', function($data){
                        $button = '<div class="d-flex justify-content-center"><button type="button" onclick="editTest('.$data->id.')" name="edit" id="'.$data->id.'" class="edit btn btn-sm d-flex justify-content-center" data-toggle="modal" data-target="#EditTestModal" data-placement="top" title="Edit"><i class="fa fa-edit" style="color: aqua"> Edit</i></button>';
                        $button .= '<button type="button" onclick="deleteModal('.$data->id.',\''.$data->test_name.'\')" name="delete" id="'.$data->id.'" class="delete btn btn-sm" data-toggle="modal" data-target="#DeleteConfirmationModal" data-placement="top" title="Delete"  style="color: red"><i class="fa fa-trash"> Delete</i></button></div>';
                        
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.testSetting');
    }

    public function addTest(Request $request)
    {
        $Test = new Test;
        $Test->test_code = $request->test_code;
        $Test->test_name = $request->test_name;
        $Test->test_price = $request->test_price;
        $Test->save();

        if ($Test->id) {
            return response()->json(['success' => 'Test Added successfully.']);
        } else {
            return response()->json(['failed' => 'Test Added failed.']);
        }
    }

    public function editTest($id)
    {
        $Test = Test::find($id);
        return response()->json($Test);
    }

    public function updateTest(Request $request)
    {
        $Test = Test::find($request->id);
        $Test->test_code = $request->test_code;
        $Test->test_name = $request->test_name;
        $Test->test_price = $request->test_price;
        $Test->save();
    
        if ($Test->id) {
            return response()->json(['success' => 'Test Info Update successfully !!!']);
        } else {
            return response()->json(['falied' => 'Test Info Update Nothing.']);
        }
    }

    public function deleteTest($id)
    {
        $Test = Test::find($id)->delete();
        // $flight->delete();
        if ($Test) {
            return response()->json(['success' => 'Test Delete successfully !!!']);
        } else {
            return response()->json(['falied' => 'Test Delete falied !!!']);
        }
    }
}
