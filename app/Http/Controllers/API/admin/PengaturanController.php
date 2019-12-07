<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\admin\KonfigWeb;

use Image;
class PengaturanController extends Controller
{
    public function index(){
        $pengaturan = KonfigWeb::first();

        return response()->json($pengaturan);
    }

    public function store(Request $request){
        $request->validate([
            'favicon' => 'sometimes',
            'logo' => 'sometimes',
            'judul_web' => 'required',
            'deskripsi_web' => 'sometimes',
            'facebook' => 'sometimes',
            'instagram' => 'sometimes',
            'email' => 'sometimes',
            'whatsapp' => 'sometimes',
            'footer' => 'required',
            'header' => 'sometimes',
        ]);

        DB::beginTransaction();
        try {
            $konfig = KonfigWeb::where('id', '1')->first();
            if (!$konfig) {
                $new = new KonfigWeb;
                $new->judul_web = $request->judul_web;
                $new->deskripsi_web = $request->deskripsi_web;
                $new->facebook = $request->facebook;
                $new->instagram = $request->instagram;
                $new->email = $request->email;
                $new->whatsapp = $request->whatsapp;
                $new->footer = $request->footer;

                $favicon = time().'.' . explode('/', explode(':', substr($request->favicon, 0, strpos($request->favicon, ';')))[1])[1];
                Image::make($request->favicon)->save(public_path('img/icon/').$favicon);

                $logo = time().'.' . explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
                Image::make($request->logo)->save(public_path('img/icon/').$logo);

                $header = time().'.' . explode('/', explode(':', substr($request->header, 0, strpos($request->header, ';')))[1])[1];
                Image::make($request->header)->save(public_path('img/icon/').$header);

                $new->favicon = '/img/icon/' . $favicon;
                $new->logo = '/img/icon/' . $logo;
                $new->header = '/img/icon/' . $header;
                $new->save();
            } else {
                // dd('diupdate');
                $konfig->judul_web = $request->judul_web;
                $konfig->deskripsi_web = $request->deskripsi_web;
                $konfig->facebook = $request->facebook;
                $konfig->instagram = $request->instagram;
                $konfig->email = $request->email;
                $konfig->whatsapp = $request->whatsapp;
                $konfig->footer = $request->footer;

                if ($request->favicon != $konfig->favicon) {
                    $favicon = time().'.' . explode('/', explode(':', substr($request->favicon, 0, strpos($request->favicon, ';')))[1])[1];
                    Image::make($request->favicon)->save(public_path('img/icon/').$favicon);

                    $konfig->favicon = '/img/icon/' . $favicon;
                }
                if ($request->logo != $konfig->logo) {
                    $logo = time().'.' . explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
                    Image::make($request->logo)->save(public_path('img/icon/').$logo);

                    $konfig->logo = '/img/icon/' . $logo;
                }
                if ($request->header != $konfig->header) {
                    $header = time().'.' . explode('/', explode(':', substr($request->header, 0, strpos($request->header, ';')))[1])[1];
                    Image::make($request->header)->save(public_path('img/icon/').$header);

                    $konfig->header = '/img/icon/' . $header;
                }

                $konfig->save();
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return response()->json([
            'status' => true,
            // 'message' => 'Berhasil diupdate',
        ]);

    }
}
