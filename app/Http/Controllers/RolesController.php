<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index() {

        $roles = Role::get();
        return view('roles.index',[
            'roles' => $roles
        ]);
    }

    public function create(Request $request){

        if(request()->isMethod('post')) {
            
            $validated = $request->validate([
                'name' => 'required',
                'status' => 'required',
            ]);

            Role::create([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);

            return redirect()->back()->with('success', 'Role Created');
        }
        return view('roles.form');
    }

    public function edit(Request $request,$id) {

        $role = Role::findOrFail($id);
        if(request()->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required',
                'status' => 'required',
            ]);

            $role->update([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);

            return redirect()->back()->with('success', 'Role Updated');
        }
        return view('roles.form',[
            'role' => $role
        ]);
    }

    public function destroy($id)
    {
        $menu = Role::findOrFail($id);
        $menu->delete(); // This will set deleted_at, not hard-delete
    
        return redirect()->route('addRole')->with('success', 'Role soft deleted successfully.');
    }
    
}
