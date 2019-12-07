<?php

namespace App\Http\Controllers\API\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\admin\Produk;
class ProdukController extends Controller
{
    public function index(){
        $produk = DB::table('produk')
                        ->join('foto_produk', 'foto_produk.id_produk', 'produk.id')
                        ->select(DB::raw("produk.id, produk.nama_produk, produk.deskripsi, foto_produk.foto"))
                        ->get();

        return response()->json($produk);
    }
}
