<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ExpenseHistoryController extends Controller
{
    public function expenseHistory(Request $request)
    {
        if (isset($request->from_datepicker)) {
            
            $historys = DB::table('daily_expenses')
            ->join('expenses', 'daily_expenses.expence_id', '=', 'expenses.id')
            ->join('users', 'daily_expenses.user_id', '=', 'users.id')
            ->select('users.name','expenses.expence_name','daily_expenses.ammount','daily_expenses.expence_description','daily_expenses.created_at')
            ->whereBetween('daily_expenses.created_at', [$request->from_datepicker, $request->to_datepicker])
            ->get();
            $no = 1;
            return view('admin.expenseHistory', compact('historys','no'));
        }
        return view('admin.expenseHistory');
    }
}
