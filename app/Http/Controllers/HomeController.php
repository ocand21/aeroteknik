<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\admin\KonfigWeb;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $konfig = KonfigWeb::first();

        return view('layouts.app', compact('konfig'));
    }
}
