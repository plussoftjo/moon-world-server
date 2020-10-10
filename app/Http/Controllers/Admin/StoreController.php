<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\shop_order;
use App\items;
use App\shop_category;
class StoreController extends Controller
{
    public function index_order() 
    {
        return response()->json(shop_order::get());
    }

    public function show_order($id) {
        return response()->json(shop_order::where('id',$id)->first());
    }

    public function vertify($id) {
        shop_order::where('id',$id)->update([
            'state' => 1
        ]);
    }

    public function overview () 
    {
        $items_count = items::count();
        $shop_category = shop_category::count();
        $shop_order = shop_order::count();

        return response()->json(['items_count' => $items_count,'shop_category' => $shop_category,'shop_order' => $shop_order]);
    }
}
