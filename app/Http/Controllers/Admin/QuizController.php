<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\quiz;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(quiz::get());
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
         Image::make($request->get('image'))->save(public_path('images/quiz/').$fileNameimage);
 
         /** Save */
         $input = $request->all();
         $quiz = quiz::create([
             'name_ar' => $input['name_ar'],
             'name_en' => $input['name_en'],
             'description_ar' => $input['description_ar'],
             'description_en' => $input['description_en'],
             'price' => $input['price'],
             'image' => 'images/quiz/'.$fileNameimage
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
        return response()->json(quiz::where('id',$id)->first());
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
        quiz::where('id',$id)->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'price' => $request->price,
        ]);
    }

    public function updateImage(Request $request, $id)
    {
        $image = $request->get('image');
         $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
         Image::make($request->get('image'))->save(public_path('images/quiz/').$fileNameimage);
        quiz::where('id',$id)->update([
            'image' => 'images/quiz/'.$fileNameimage
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
        quiz::where('id',$id)->delete();
    }
}
