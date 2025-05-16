<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {

        $menus = Menu::get();
        return view('menu.index', [
            'menus' => $menus
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validate the incoming request
            $validated = $request->validate([
                'name' => 'required',
                'url' => 'required',
                'icon_class' => 'required',
                'parent_id' => 'nullable',
                'status' => 'required',
                'roles_allowed' => 'nullable|array', // Expecting array of role IDs
            ]);
    
            // Store roles_allowed as JSON string
            $validated['roles_allowed'] = isset($validated['roles_allowed'])
                ? json_encode($validated['roles_allowed'])
                : json_encode([]);
    
            // Create the menu
            Menu::create($validated);
    
            // Redirect with success message
            return redirect()->route('addMenu')->with('success', 'Menu Created');
        }
    
        // Get roles and parent menus for the form
        $roles = Role::all();
        $parentMenus = Menu::whereNull('parent_id')->where('status', 1)->get();
    
        return view("menu.form", [
            'parentMenus' => $parentMenus,
            'roles' => $roles
        ]);
    }    
    

    public function edit(Request $request, $menu_id)
    {
        $menus = Menu::findOrFail($menu_id);

        if(request()->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required',
                'url' => 'required',
                'icon_class' => 'required',
                'parent_id' => 'nullable',
                'status' => 'required',
                'roles_allowed' => 'nullable|array', // Expect array from form multiple select
            ]);

            $menus->update($validated);

            return redirect()->route('addMenu')->with('success', 'Menu Updated');
        }
        $roles = Role::all();
        return view('menu.form', [
            'menu' => $menus,
            'roles' => $roles
        ]);
    }
}
