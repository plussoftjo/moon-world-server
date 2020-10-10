<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\shop_category;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
use App\items;

class ShopCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(shop_category::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** Image Modefy */
        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/shop_category/').$fileNameimage);


        $input = $request->all();
        $shop_category = shop_category::create([
            'name_ar' => $input['name_ar'],
            'name_en' => $input['name_en'],
            'description_ar' => $input['description_ar'],
            'description_en' => $input['description_en'],
            'name_ar' => $input['name_ar'],
            'image' => 'images/shop_category/'.$fileNameimage
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
        return response()->json(shop_category::where('id',$id)->first());
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
        shop_category::where('id',$id)->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
        ]);
    }

    public function updateImage(Request $request, $id)
    {
        /** Image Modefy */
        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/shop_category/').$fileNameimage);

        shop_category::where('id',$id)->update([
            'image' => 'images/shop_category/'.$fileNameimage
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
        shop_category::where('id',$id)->delete();
        items::where('shop_category_id',$id)->delete();
    }
}
