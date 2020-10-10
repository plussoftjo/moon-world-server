<?php

namespace App\Http\Controllers\ApiAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\quiz_ticket;
use App\quiz_awnser;
use App\quiz_admin_awnser;
class QuizController extends Controller
{
    public function index() {
        $new_data = quiz_ticket::where('state',0)->get();
        $all_data = quiz_ticket::get();

        return response()->json(['new_data' => $new_data,'all_data' => $all_data]);
    }

    public function show($id) {
        $selected_ticket = quiz_ticket::where('id',$id)->first();
        $user = User::where('id',$selected_ticket->user_id)->first();
        $quiz_awnsers = quiz_awnser::where('user_id',$selected_ticket->user_id)->where('quiz_id',$selected_ticket->quiz_id)->get();
        return response()->json(['selected_ticket' => $selected_ticket,'user' => $user,'quiz_awnsers' => $quiz_awnsers]);
    } 

    public function complate_order(Request $request,$id) {
        $selected_ticket = quiz_ticket::where('id',$id)->first();
        quiz_admin_awnser::create([
            'user_id' => $selected_ticket->user_id,
            'quiz_id' => $id,
            'awnser' => $request->awnser
        ]);
        quiz_ticket::where('id',$id)->update([
            'state' => 1
        ]);
    }
}
