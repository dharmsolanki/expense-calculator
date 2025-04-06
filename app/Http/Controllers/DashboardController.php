<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function create(Request $request) {

        if(request()->isMethod('post')) {
            $validaated = $request->validate(
                [
                    'category' => 'required',
                    'expense_name' => 'required_if:category,Other',
                    'payment_method' => 'required',
                    'date' => 'required',
                    'amount' => 'required|numeric',
                    'description' => 'required',
                ]
            );

            echo '<pre>'; print_r($validaated);exit();
        }
        return view('dashboard.create');
    }
}
