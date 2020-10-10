<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\sectiona_ticket;
use App\User;
use App\message;
use App\quiz_ticket;
use App\quiz_awnser;
use App\quiz_admin_awnser;
class ProcessController extends Controller
{
    public function sectiona_index() 
    {
        $new_data = sectiona_ticket::where('state',0)->get();
        $all_data = sectiona_ticket::get();

        return response()->json(['new_data' => $new_data,'all_data' => $all_data]);
    }

    public function sectiona_show($id)
    {
        $sectiona = sectiona_ticket::where('id',$id)->first();
        $user = User::where('id',$sectiona->user_id)->first();

        return response()->json(['sectiona' => $sectiona,'user' => $user]);
    } 

    public function sectiona_fetch_message($id) 
    {
        $message = message::where('sectiona_ticket_id',$id)->get();
        return response()->json($message);
    }

    public function admin_send_message(Request $request) 
    {
        $message = message::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'sectiona_ticket_id' => $request->sectiona_ticket_id,
            'sender' => 2
        ]);
    }
    public function sectiona_change_state($id)
    {
        sectiona_ticket::where('id',$id)->update([
            'state' => 1
        ]);
    }




    /** ============ Quiz ============ */
    public function quiz_index() 
    {
        $new_data = quiz_ticket::where('state',0)->get();
        $all_data = quiz_ticket::get();

        return response()->json(['new_data' => $new_data,'all_data' => $all_data]);
    }

    public function quiz_show($id)
    {
        $quiz_ticket = quiz_ticket::where('id',$id)->first();
        $user = User::where('id',$quiz_ticket->user_id)->first();


        $quiz_awnser = quiz_awnser::where('quiz_id',$quiz_ticket->quiz_id)->where('user_id',$quiz_ticket->user_id)->get();
        
        return response()->json(['quiz_ticket' => $quiz_ticket,'user' => $user,'quiz_awnser' => $quiz_awnser]);
    } 

    public function quiz_send_result(Request $request)
    {
        quiz_admin_awnser::create([
            'user_id' => $request->user_id,
            'quiz_id' => $request->quiz_id,
            'awnser' => $request->awnser
        ]);
        quiz_ticket::where('id',$request->id)->update([
            'state' => 2
        ]);
    }
}
