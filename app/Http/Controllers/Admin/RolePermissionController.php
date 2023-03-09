<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::whereNot('name', 'Super Admin')->get();
        $permissions = Permission::get();
        return view('Admin.pages.roles-permissions.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Role::create(['name' => $request->name]);
            return back()->with('success', 'Role Created Successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Role Not Created.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $permissions=Role::findOrFail($id)->permissions;
            return $this->successResponse($permissions);
        } catch (\Throwable $th) {
            return $this->badRequestResponse($th->getMessage());
        }



    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function updatePermissions(Request $request)
    {
        try {
            $role=Role::findorFail($request->role);
            $role->syncPermissions($request->permission);
            return back()->with('success', 'Permission Syncronized Successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Permission Not Syncronized.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
