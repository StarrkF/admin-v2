<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function index()
    {
        $users = User::get();
        return view('Admin.pages.users.index', compact('users'));
    }


    public function indexLogin()
    {
        return view('Auth.login');
    }

    public function register(RegisterRequest $request)
    {
        try {
            if (Auth::user()->can('create-users')) {
                User::create($request->validated());
                return back()->with('success','Account successfully created.');
            }
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
}
