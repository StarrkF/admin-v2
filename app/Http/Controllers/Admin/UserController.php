<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function index()
    {
        $users = User::get();
        $roles = Role::get();
        return view('Admin.pages.users.index', compact('users', 'roles'));
    }


    public function indexLogin()
    {
        return view('Auth.login');
    }

    public function register(RegisterRequest $request)
    {
        try {
            if (Auth::user()->can('create-user')) {
                User::create($request->validated());
                return back()->with('success','Account successfully created.');
            }
            return back()->with('error','You do not have create permssion');
        } catch (\Throwable $th) {
            return back()->with('error','Account create Failed.');
        }
    }

    public function login(LoginRequest $request)
    {
        return  Auth::attempt($request->validated())
        ? redirect()->route('get.admin.dashboard')
        : back()->with('error','Email or password incorrect');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('get.login');
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return $this->successResponse($user);
        } catch (\Throwable $th) {
            return $this->notFoundResponse();
        }
    }

    public function update(Request $request)
    {
        try {
            $user = User::findOrFail($request->hidden_id);
            $user->name = $request->name;
            $user->email = $request->name;
            $user->syncRoles($request->role);
            $user->save();
            return back()->with('success', 'User updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'User not updated');
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $delete = $user->delete();

        return $delete
        ? back()->with('success', 'User deleted successfully')
        : back()->with('error', 'User not deleted');

    }
}
