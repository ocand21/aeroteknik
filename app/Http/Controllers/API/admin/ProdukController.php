<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\admin\Produk;
use App\Models\admin\FotoProduk;
use Str;
use Image;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = DB::table('produk')
                    ->join('foto_produk', 'foto_produk.id_produk', 'produk.id')
                    ->select(DB::raw("produk.id, foto_produk.foto, produk.nama_produk"))
                    ->get();

        return response()->json($produk);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|array',
            'foto.*' => 'required',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $produk = Produk::create([
                'nama_produk' => $request->nama_produk,
                'slug' => Str::slug($request->nama_produk),
                'deskripsi' => $request->deskripsi,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        try {
            $foto = $request->file('foto');
            $nomor = '0';
            foreach ($foto as $ft) {
                $nomor++;
                $filename = time() . '-' . $produk->nama_produk . '.' . $ft->getClientOriginalExtension();
                Image::make($ft)->save(public_path('img/produk/').$filename);

                $foto = FotoProduk::create([
                    'id_produk' => $produk->id,
                    'foto' => '/img/produk/' . $filename,
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil ditambah',
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);

        return response()->json($produk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'sometimes|array',
            'foto.*' => 'sometimes',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $produk = Produk::findOrFail($id);
            $produk->update([
                'nama_produk' => $request->nama_produk,
                'deskripsi' => $request->deskripsi,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        try {
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $nomor = '0';
                foreach ($foto as $ft) {
                    $nomor++;
                    $filename = time() . '-' . $produk->nama_produk . '.' . $ft->getClientOriginalExtension();
                    Image::make($ft)->save(public_path('img/produk/').$filename);

                    $foto = FotoProduk::create([
                        'id_produk' => $produk->id,
                        'foto' => '/img/produk/' . $filename,
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil diubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
