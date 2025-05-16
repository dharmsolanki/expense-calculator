<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $query = User::with('role');
    
        // Apply filters if provided
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
    
        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        $users = $query->get(); // Or use paginate() if needed
        $roles = Role::get();
    
        return view("users.index", [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
    
    
    public function create(Request $request)
    {
        $roles = Role::all();
    
        if ($request->isMethod("post")) {
            // Validate the input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'role_id' => 'nullable|exists:roles,id',
                'status' => 'required|in:0,1',
            ]);
    
            // Create user
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->role_id = $data['role_id'] ?? 2;
            $user->status = $validatedData['status'];
            $user->save();
    
            return redirect()->route('addUser')->with('success', 'User created successfully.');
        }
    
        return view('users.form', [
            'roles' => $roles
        ]);
    }
    

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
    
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,  // exclude current user from unique check
                'password' => 'nullable|confirmed|min:6', // password is optional on update
                'role_id' => 'nullable|exists:roles,id',
                'status' => 'required|in:0,1',
            ]);
    
            // Prepare data to update
            $dataToUpdate = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'role_id' => $validatedData['role_id'] ?? $user->role_id,
                'status' => $validatedData['status'],
            ];
    
            // Only update password if provided
            if (!empty($validatedData['password'])) {
                $dataToUpdate['password'] = Hash::make($validatedData['password']);
            }
    
            $user->update($dataToUpdate);
    
            return redirect()->route('addUser')->with('success', 'User updated successfully.');
        }
    
        return view('users.form', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }
    
}
