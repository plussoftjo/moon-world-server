<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\message;
use Auth;
class ChatController extends Controller
{
    public function store_user_message(Request $request) 
    {
        $message = message::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'sectiona_ticket_id' => $request->sectiona_ticket_id,
            'sender' => 1
        ]);
        
    }

    public function store_admin_message(Request $request) 
    {
        $message = message::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'sectiona_ticket_id' => $request->sectiona_ticket_id,
            'sender' => 2
        ]);
    }

    public function fetch_user_message(Request $request) {
        $message = message::where('user_id',Auth::id())->where('sectiona_ticket_id',$request->sectiona_ticket_id)->get();
        return response()->json($message);
    }
}
