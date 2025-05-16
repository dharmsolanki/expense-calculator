<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function signUp(Request $request)
    {
        if (request()->isMethod('post')) {
            $validatted = $request->validate(
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6|confirmed',
                ],
                [
                    'name.required' => 'The name field is required.',
                    'email.required' => 'We need your email address!',
                    'email.email' => 'Please enter a valid email address.',
                    'email.unique' => 'This email is already registered.',
                    'password.required' => 'Please enter your password.',
                    'password.min' => 'Password must be at least 6 characters long.',
                    'password.confirmed' => 'Passwords do not match!',
                ],
            );

            User::create([
                'name' => $validatted['name'],
                'email' => $validatted['email'],
                'password' => bcrypt($validatted['password']),
            ]);

            return redirect()->back()->with('success', 'Registration Successfull');
        }
        return view('welcome')->with('error', 'invalid Request Method');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $messages = [
                'email.required' => 'Please enter your email address.',
                'email.email' => 'Enter a valid email address.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 6 characters long.',
            ];

            $request->validate(
                [
                    'email' => 'required|email',
                    'password' => 'required|min:6',
                ],
                $messages
            );

            // Attempt login only if user is active (status = 1)
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'status' => 1, // Only allow active users
            ];

            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard')->with('success', 'Login Successful!');
            }

            return back()->with('error', 'Invalid email, password, or your account is inactive.');
        }

        // if user already logged in
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        return view('welcome')->with('error', 'Invalid Request Method');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // or wherever you want
    }
}
