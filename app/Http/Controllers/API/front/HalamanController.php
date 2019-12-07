<?php

namespace App\Http\Controllers\API\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\admin\Halaman;
class HalamanController extends Controller
{
    public function getHalaman($slug){
        $halaman = Halaman::where('slug', $slug)->first();

        return response()->json($halaman);
    }

    // public function getPrincipals(){
    //     $principals = Halaman::where('slug', 'principals')->first();
    //
    //     return response()->json($principals);
    // }
}
