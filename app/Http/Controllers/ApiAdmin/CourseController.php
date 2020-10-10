<?php

namespace App\Http\Controllers\ApiAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\course_ticket;
use App\User;
class CourseController extends Controller
{
    public function index() {
        $currentMonth = date('m');
        $new_data = course_ticket::whereRaw('MONTH(created_at) = ?',[$currentMonth])->get();
        $all_data = course_ticket::get();

        return response()->json(['new_data' => $new_data,'all_data' => $all_data]);
    }

    public function show($id) {
        $course_ticket = course_ticket::where('id',$id)->first();
        $user = User::where('id',$course_ticket->user_id)->first();

        return response()->json(['user' => $user,'course_ticket' => $course_ticket]);
    }
}
