<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment\Cashier;
use App\sectiona_ticket;
use App\course_ticket;
use App\quiz_ticket;
class PayController extends Controller
{
    public function pay(Request $request) {



        /** INJECT_SERVER_WITH_TICKET */

        if($request->type == "sectiona") {
            $sectiona_ticket = sectiona_ticket::create([
                'user_id' => $request->user_id,
                'psychologicalcounseling_id' => $request->id,
                'price' => $request->price,
            ]);

            $ticket = sectiona_ticket::where('id',$sectiona_ticket->id)->first();
        }

        if($request->type == 'course') {
            $course_ticket = course_ticket::create([
                'user_id' => $request->user_id,
                'course_id' => $request->id,
                'price' => $request->price
            ]);
            $ticket = course_ticket::where('id',$course_ticket->id)->first();
        }

        if($request->type == 'quiz') {
            $quiz_ticket = quiz_ticket::create([
                'user_id' => $request->user_id,
                'quiz_id' => $request->id,
                'price' => $request->price
            ]);
            $ticket = quiz_ticket::where('id',$quiz_ticket->id)->first();
        }
        return response()->json(['msg' => $ticket],200);
        
    }
}
