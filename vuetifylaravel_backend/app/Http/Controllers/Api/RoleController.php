<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json(['roles' => Role::all()], 200);
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);
        
        return response()->json(['role' => $role], 200);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        
        return response()->json(['role' => $role], 200);
    }

    public function destroy($id)
    {
        $role = Role::find($id)->delete();
        return response()->json(['role' => $role], 200);
    }
}
