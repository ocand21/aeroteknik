<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\admin\Halaman;
use Str;
use Image;
class HalamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halaman = Halaman::get();

        return response()->json($halaman);
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
            'foto' => 'sometimes',
            'judul' => 'required',
            'isi' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $halaman = new Halaman;
            $halaman->judul = $request->judul;
            $halaman->slug = Str::slug($request->judul);
            $halaman->isi = $request->isi;

            if ($request->foto) {
                $foto = time().'.' . explode('/', explode(':', substr($request->foto, 0, strpos($request->foto, ';')))[1])[1];
                Image::make($request->foto)->save(public_path('img/halaman/').$foto);

                $halaman->foto = '/img/halaman/' . $foto;
            }

            $halaman->save();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Halaman berhasil disimpan',
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
        $halaman = Halaman::findOrFail($id);

        return response()->json($halaman);
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
            'foto' => 'sometimes',
            'judul' => 'required',
            'isi' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $halaman = Halaman::findOrFail($id);

            $halaman->judul = $request->judul;
            $halaman->slug = Str::slug($request->judul);
            $halaman->isi = $request->isi;

            if ($request->foto != $halaman->foto) {
                $foto = time().'.' . explode('/', explode(':', substr($request->foto, 0, strpos($request->foto, ';')))[1])[1];
                Image::make($request->foto)->save(public_path('img/halaman/').$foto);

                $halaman->foto = '/img/halaman/' . $foto;
            }

            $halaman->save();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Halaman berhasil diubah',
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
