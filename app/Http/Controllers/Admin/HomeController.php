<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('Admin.pages.dashboard');
    }

    public function changeLang(String $lang)
    {
        App::setLocale($lang);
        Session::put('locale', $lang);

    }
}
