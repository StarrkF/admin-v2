<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        return view('Admin.pages.dashboard');
    }

    public function changeLang(Request $request)
    {
        if($request->lang)
        {
            App::setLocale($request->lang);
            return back();
        }
        App::setLocale('en');
        return back();
    }
}
