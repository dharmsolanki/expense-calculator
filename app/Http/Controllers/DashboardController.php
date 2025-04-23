<?php

namespace App\Http\Controllers;

use App\Models\ExpenseData;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index')->with('success', 'Login Successfully');
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

            ExpenseData::create([
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

    public function view() {
        
        $expenses = ExpenseData::all();
        return view('dashboard.view-expense', [
            'expenses' => $expenses
        ]);

    }
}
