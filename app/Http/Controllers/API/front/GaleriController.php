<?php

namespace App\Http\Controllers\API\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\admin\Galeri;
class GaleriController extends Controller
{
    public function getGaleri(){
        $galeri = Galeri::all()->pluck('foto');

        return response()->json($galeri);
    }
}
