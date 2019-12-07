<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\admin\Galeri;

use Str;
use Image;
class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeri = Galeri::get();

        return response()->json($galeri);
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
            'foto.*' => 'required|',
            'deskripsi' => 'sometimes',
        ]);

        DB::beginTransaction();
        try {
            $foto = $request->file('foto');
            $nomor = '0';
            foreach ($foto as $ft) {
                $nomor++;
                $filename = time() . '-' . 'galeri' . '.' . $ft->getClientOriginalExtension();
                Image::make($ft)->save(public_path('img/galeri/').$filename);

                $galeri = Galeri::create([
                    'foto' => '/img/galeri/' . $filename,
                    'deskripsi' => $request->deskripsi,
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Galeri berhasil ditambah',
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
        //
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
        //
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
