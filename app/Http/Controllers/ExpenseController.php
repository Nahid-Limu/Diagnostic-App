<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Expense;
class ExpenseController extends Controller
{
    public function expenseSetting()
    {
        $Expense = Expense::all(['id','expence_name','remarke']);

        if(request()->ajax())
        {
            return datatables()->of($Expense)
                    
                    ->addColumn('action', function($data){
                        $button = '<div class="d-flex justify-content-center"><button type="button" onclick="editExpense('.$data->id.')" name="edit" id="'.$data->id.'" class="edit btn btn-sm d-flex justify-content-center" data-toggle="modal" data-target="#EditExpenseModal" data-placement="top" title="Edit"><i class="fa fa-edit" style="color: aqua"> Edit</i></button>';
                        $button .= '<button type="button" onclick="deleteModal('.$data->id.',\''.$data->expence_name.'\')" name="delete" id="'.$data->id.'" class="delete btn btn-sm" data-toggle="modal" data-target="#DeleteConfirmationModal" data-placement="top" title="Delete"  style="color: red"><i class="fa fa-trash"> Delete</i></button></div>';
                        
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.expenseSetting');
    }

    public function addExpense(Request $request)
    {
        $Expense = new Expense;
        $Expense->expence_name = $request->expence_name;
        $Expense->remarke = $request->remarke;
        $Expense->save();

        if ($Expense->id) {
            return response()->json(['success' => 'Expense Create successfully.']);
        } else {
            return response()->json(['failed' => 'Expense Create failed.']);
        }
    }

    public function editExpense($id)
    {
        $Expense = Expense::find($id);
        return response()->json($Expense);
    }

    public function updateExpense(Request $request)
    {
        $Expense = Expense::find($request->id);
        $Expense->expence_name = $request->expence_name;
        $Expense->remarke = $request->remarke;
        $Expense->save();
    
        if ($Expense->id) {
            return response()->json(['success' => 'Expense Info Update successfully !!!']);
        } else {
            return response()->json(['falied' => 'Expense Info Update Nothing.']);
        }
    }

    public function deleteExpense($id)
    {
        $Expense = Expense::find($id)->delete();
        // $flight->delete();
        if ($Expense) {
            return response()->json(['success' => 'Expense Delete successfully !!!']);
        } else {
            return response()->json(['falied' => 'Expense Delete falied !!!']);
        }
    }
}
