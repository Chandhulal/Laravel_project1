<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    //
    public function show()
    {
        $mails = Support::all();
        return view('templates.admin_faq_mails',['mails'=>$mails]);
    }

    public function store($id)
    {
        Support::create([
            "user_id" => $id,
            "message" => request()->message,
        ]);
        return response()->json([
            "success",
        ]);
    }

    public function destroy($id)
    {
        $mail = Support::find($id);
        $mail->delete();
        return response()->json([
            'deleted',
        ]);
    }

}
