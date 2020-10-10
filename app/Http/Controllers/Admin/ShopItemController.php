<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\items;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
class ShopItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(items::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/items/').$fileNameimage);



        $input = $request->all();
        $items = items::create([
            'name_ar' => $input['name_ar'],
            'name_en' => $input['name_en'],
            'description_ar' => $input['description_ar'],
            'description_en' => $input['description_en'],
            'name_ar' => $input['name_ar'],
            'image' => 'images/items/'.$fileNameimage,
            'price' => $input['price'],
            'shop_category_id' => $input['shop_category_id']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(items::where('id',$id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        items::where('id',$id)->update([
            'shop_category_id' => $request->shop_category_id,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'price' => $request->price,

        ]);
    }

    public function updateImage(Request $request, $id)
    {
        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/items/').$fileNameimage);

        items::where('id',$id)->update([
            'image' => 'images/items/'.$fileNameimage
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        items::where('id',$id)->delete();
    }
}
