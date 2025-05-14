<?php

namespace App\Http\Controllers;

use App\Models\ExpenseData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $users = User::where('id','!=','1')->get();

        if($userId == User::ADMIN_USER_ID) {
            $total_expense = ExpenseData::sum('expense_amount');
        }
        else {
            $total_expense = ExpenseData::where('user_id',$userId)->sum('expense_amount');
        }

        return view('dashboard.index',[
            'users' => $users,
            'total_expense' => $total_expense
        ])->with('success', 'Login Successfully');
    }

    public function create(Request $request) {

        if(request()->isMethod('post')) {
            $validated = $request->validate(
                [
                    'category' => 'required',
                    'expense_name' => 'required_if:category,Other',
                    'payment_method' => 'required',
                    'date' => 'required',
                    'amount' => 'required|numeric',
                    'description' => 'required',
                ]
            );

            $userId = Auth::id();

            ExpenseData::create([
                'user_id' => $userId,
                'expense_category' => $validated['category'],
                'expense_name' => $validated['expense_name'],
                'payment_method' => $validated['payment_method'],
                'expense_date' => $validated['date'],
                'expense_amount' => $validated['amount'],
                'expense_description' => $validated['description'],
            ]);

            return redirect()->back()->with('success', 'Expense Added Successfully!');
        }
        return view('dashboard.create');
    }

    public function view(Request $request) {
        
        $userId = Auth::id();
        if($userId == User::ADMIN_USER_ID) {
            $query = ExpenseData::query();
        }
        else {
            $query = ExpenseData::where('user_id', $userId);
        }

        if ($request->filled('category')) {
            $query->where('expense_category', $request->category);
        }
    
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }
    
        if ($request->filled('from_date')) {
            $query->whereDate('expense_date', '>=', $request->from_date);
        }
    
        if ($request->filled('to_date')) {
            $query->whereDate('expense_date', '<=', $request->to_date);
        }

        $expenses = $query->orderBy('expense_date', 'desc')->get();

        return view('dashboard.view-expense', [
            'expenses' => $expenses
        ]);

    }

    public function edit(Request $request, $id)
    {
        $expense = ExpenseData::findOrFail($id);
    
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'category' => 'required',
                'expense_name' => 'required_if:category,Other',
                'payment_method' => 'required',
                'date' => 'required',
                'amount' => 'required|numeric',
                'description' => 'required',
            ]);
    
            // ✅ Correct usage: calling update on the model instance
            $expense->update([
                'expense_category' => $validated['category'],
                'expense_name' => $validated['expense_name'],
                'payment_method' => $validated['payment_method'],
                'expense_date' => $validated['date'],
                'expense_amount' => $validated['amount'],
                'expense_description' => $validated['description'],
            ]);
    
            return redirect('dashboard/view-expense')->with('success', 'Expense Updated Successfully!');
        }
    
        return view('dashboard.create', [
            'expense' => $expense
        ]);
    }
    
}
