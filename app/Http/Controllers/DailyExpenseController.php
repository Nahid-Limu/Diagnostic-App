<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DailyExpense;
use App\Expense;
use Auth;
use DB;
class DailyExpenseController extends Controller
{
    public function dailyExpense()
    {
        // $DailyExpense = DailyExpense::all(['id','expence_name']);
        $DailyExpense = DB::table('daily_expenses')
            ->join('expenses', 'daily_expenses.expence_id', '=', 'expenses.id')
            ->join('users', 'daily_expenses.user_id', '=', 'users.id')
            ->select('daily_expenses.id','expenses.expence_name','daily_expenses.ammount','daily_expenses.expence_description','users.name','daily_expenses.created_at')
            ->get();

        if(request()->ajax())
        {
            return datatables()->of($DailyExpense)

                    ->editColumn('created_at', function($data) {
                        return date('Y-m-d', strtotime( $data->created_at));
                    })
                    
                    ->addColumn('action', function($data){
                        $button = '<div class="d-flex justify-content-center"><button type="button" onclick="editDailyExpense('.$data->id.')" name="edit" id="'.$data->id.'" class="edit btn btn-sm d-flex justify-content-center" data-toggle="modal" data-target="#EditDailyExpenseModal" data-placement="top" title="Edit"><i class="fa fa-edit" style="color: aqua"> Edit</i></button>';
                        $button .= '<button type="button" onclick="deleteModal('.$data->id.',\''.$data->expence_name.'\')" name="delete" id="'.$data->id.'" class="delete btn btn-sm" data-toggle="modal" data-target="#DeleteConfirmationModal" data-placement="top" title="Delete"  style="color: red"><i class="fa fa-trash"> Delete</i></button></div>';
                        
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }

        $Expenses = Expense::all(['id','expence_name']);
        return view('admin.dailyExpense', compact('Expenses'));
    }

    public function addDailyExpense(Request $request)
    {
        $DailyExpense = new DailyExpense;
        $DailyExpense->user_id = Auth::user()->id;
        $DailyExpense->expence_id = $request->expence_id;
        $DailyExpense->ammount = $request->ammount;
        $DailyExpense->expence_description = $request->expence_description;
        $DailyExpense->save();

        if ($DailyExpense->id) {
            return response()->json(['success' => 'Todays New Expense Added successfully.']);
        } else {
            return response()->json(['failed' => 'Daily Expense Create failed.']);
        }
    }

    public function editDailyExpense($id)
    {
        $DailyExpense = DailyExpense::find($id);
        return response()->json($DailyExpense);
    }

    public function updateDailyExpense(Request $request)
    {
        $ThisDay = date("Y-m-d");
        $DailyExpense = DailyExpense::find($request->id);
        if (date('Y-m-d', strtotime( $DailyExpense->created_at )) == $ThisDay ) {
            $DailyExpense->user_id = Auth::user()->id;
            $DailyExpense->expence_id = $request->expence_id;
            $DailyExpense->ammount = $request->ammount;
            $DailyExpense->expence_description = $request->expence_description;
            $DailyExpense->save();
            return response()->json(['success' => 'Daily Expense Info Update successfully !!!']);
        }

        return response()->json(['falied' => 'This Is Not Todays,So Info Can Not be Updated.']);
    }

    public function deleteDailyExpense($id)
    {
        $ThisDay = date("Y-m-d");
        $DailyExpense = DailyExpense::find($id);

        if (date('Y-m-d', strtotime( $DailyExpense->created_at )) == $ThisDay ) {
            $DailyExpense->delete();
            return response()->json(['success' => 'Daily Expense Delete successfully !!!']);
        }
        return response()->json(['falied' => 'This Is Not Todays, So Info Can Not be Deleted !!!']);
    }
}
