<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\shop_order_address;
use App\shop_order_item;
use App\shop_order;
class ShopOrderController extends Controller
{
    public function store(Request $request) {


        /** Address */
        $shop_order_address = shop_order_address::create([
            'name' => $request->address[0]['value'],
            'address' => $request->address[1]['value'],
            'phone' => $request->address[2]['value'],
            'email' => $request->address[3]['value'],
        ]);

        $shop_order = shop_order::create([
            'user_id' => $request->user_id,
            'shop_order_address_id' => $shop_order_address->id,
            'net' => $request->net
        ]);

        foreach ($request->items as $k) {
            $shop_order_item = shop_order_item::create([
                'shop_order_id' => $shop_order->id,
                'items_id' => $k['id'],
                'qty' => $k['qty']
            ]);
        }

        return response()->json($shop_order);
    }
}
