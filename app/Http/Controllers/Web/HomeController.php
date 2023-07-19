<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
//        return response()->json([auth()->user()->premium_subscription === null]);
        return view('home.index');
    }
}
