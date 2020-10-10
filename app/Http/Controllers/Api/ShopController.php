<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\shop_category;
use App\items;
class ShopController extends Controller
{
    public function index() {
        return response()->json(['shop_category' => shop_category::get(),'items' => items::get()]);
    }
}
