<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\sectiona_ticket;
use App\course_ticket;
use App\shop_order;
use App\quiz_ticket;
class ReportController extends Controller
{
    public function sectiona_index() {
        $currentMonth = date('m');
        $this_month = sectiona_ticket::whereRaw('MONTH(created_at) = ?',[$currentMonth])->get();
        return response()->json(['sectiona_ticket' => sectiona_ticket::get(),'this_month' => $this_month]);
    }

    public function course_index() {
        $currentMonth = date('m');
        $this_month = course_ticket::whereRaw('MONTH(created_at) = ?',[$currentMonth])->get();
        return response()->json(['course_ticket' => course_ticket::get(),'this_month' => $this_month]);
    }

    public function shop_index() {
        $currentMonth = date('m');
        $this_month = shop_order::whereRaw('MONTH(created_at) = ?',[$currentMonth])->get();
        return response()->json(['shop_order' => shop_order::get(),'this_month' => $this_month]);
    }

    public function quiz_index() {
        $currentMonth = date('m');
        $this_month = quiz_ticket::whereRaw('MONTH(created_at) = ?',[$currentMonth])->get();
        return response()->json(['quiz_ticket' => quiz_ticket::get(),'this_month' => $this_month]);
    }
}
