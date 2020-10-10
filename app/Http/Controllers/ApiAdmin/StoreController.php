<?php

namespace App\Http\Controllers\ApiAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\shop_order;
class StoreController extends Controller
{
    public function index() {
        $new_data = shop_order::where('state',0)->get();
        $all_data = shop_order::get();

        return response()->json(['new_data' => $new_data,'all_data' => $all_data]);
    }

    public function show($id) {
        $selected_ticket = shop_order::where('id',$id)->first();
        $user = User::where('id',$selected_ticket->user_id)->first();
        return response()->json(['selected_ticket' => $selected_ticket,'user' => $user]);
    } 

    public function complate_order($id) {
        shop_order::where('id',$id)->update([
            'state' => 1
        ]);
    }
}
