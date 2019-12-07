<?php

namespace App\Http\Controllers\API\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Str;
use App\Models\admin\Message;
class PesanController extends Controller
{
    public function sendMessage(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'sometimes',
            'subjek' => 'required',
            'isi' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $message = Message::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subjek' => $request->subjek,
                'isi' => $request->isi,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Pesan dikirim',
        ]);

    }
}
