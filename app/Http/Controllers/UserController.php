<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function userSetting()
    {
        $User = User::all(['id','name','email','is_role']);

        if(request()->ajax())
        {
            return datatables()->of($User)
                    
                    ->addColumn('action', function($data){
                        $button = '<div class="d-flex justify-content-center"><button type="button" onclick="editUser('.$data->id.')" name="edit" id="'.$data->id.'" class="edit btn btn-sm d-flex justify-content-center" data-toggle="modal" data-target="#EditUserModal" data-placement="top" title="Edit"><i class="fa fa-edit" style="color: aqua"> Edit</i></button>';
                        // $button .= '<button type="button" onclick="deleteModal('.$data->id.',\''.$data->test_name.'\')" name="delete" id="'.$data->id.'" class="delete btn btn-sm" data-toggle="modal" data-target="#DeleteConfirmationModal" data-placement="top" title="Delete"  style="color: red"><i class="fa fa-trash"> Delete</i></button></div>';
                        
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.userSetting');
    }

    public function addUser(Request $request)
    {
        $User = new User;
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->is_role = $request->role;
        $User->save();

        if ($User->id) {
            return response()->json(['success' => 'User Create successfully.']);
        } else {
            return response()->json(['failed' => 'User Create failed.']);
        }
    }

    public function editUser($id)
    {
        $User = User::find($id);
        return response()->json($User);
    }
}
