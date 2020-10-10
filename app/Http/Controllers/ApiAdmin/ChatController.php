<?php

namespace App\Http\Controllers\ApiAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\message;
class ChatController extends Controller
{
    public function index($id) {
        return response()->json(message::where('sectiona_ticket_id',$id)->get());
    }

    public function send(Request $request) {
        message::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'sectiona_ticket_id' => $request->sectiona_ticket_id,
            'sender' => 2
        ]);
    }
}
