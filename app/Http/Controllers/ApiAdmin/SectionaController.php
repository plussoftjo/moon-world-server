<?php

namespace App\Http\Controllers\ApiAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\sectiona_ticket;
use App\User;
class SectionaController extends Controller
{
    public function index() {
        $new_data = sectiona_ticket::where('state',0)->get();
        $all_data = sectiona_ticket::get();

        return response()->json(['new_data' => $new_data,'all_data' => $all_data]);
    }

    public function show($id) {
        $sectiona_ticket = sectiona_ticket::where('id',$id)->first();
        $user = User::where('id',$sectiona_ticket->user_id)->first();

        return response()->json(['user' => $user,'sectiona_ticket' => $sectiona_ticket]);
    }
}
