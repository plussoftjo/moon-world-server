<?php

namespace App\Http\Controllers\ApiAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\quiz_ticket;
use App\shop_order;
use App\sectiona_ticket;
use App\course_ticket;
class DashboardController extends Controller
{
    public function index_count() {
        $quiz_count = quiz_ticket::count();
        $sectiona_count = sectiona_ticket::count();
        $shop_count = shop_order::count();
        $course_count = course_ticket::count();
        return response()->json(['quiz_count' => $quiz_count,'sectiona_count' => $sectiona_count,'shop_count' => $shop_count,'course_count' => $course_count]);
    }
}
