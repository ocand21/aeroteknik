<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\admin\KonfigWeb;
use App\Models\admin\Halaman;
class FrontController extends Controller
{

    public function index(){
        $halaman = Halaman::get();
        $konfig = KonfigWeb::first();
        return view('layouts.public', compact('konfig', 'halaman'));
    }

}
