<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\psychologicalcounseling;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
class PsychologicalCounselingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(psychologicalcounseling::get());
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
        Image::make($request->get('image'))->save(public_path('images/psychologicalcounseling/').$fileNameimage);

        /** Save */
        $input = $request->all();
        $psychologicalcounseling = psychologicalcounseling::create([
            'name_ar' => $input['name_ar'],
            'name_en' => $input['name_en'],
            'description_ar' => $input['description_ar'],
            'description_en' => $input['description_en'],
            'price' => $input['price'],
            'image' => 'images/psychologicalcounseling/'.$fileNameimage
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
        return response()->json(psychologicalcounseling::where('id',$id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request, $id)
    {
          /** Image Modefy */
          $image = $request->get('image');
          $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          Image::make($request->get('image'))->save(public_path('images/psychologicalcounseling/').$fileNameimage);
        
          psychologicalcounseling::where('id',$id)->update([
              'image' => 'images/psychologicalcounseling/'.$fileNameimage
          ]);

    }


    public function update(Request $request, $id)
    {
        psychologicalcounseling::where('id',$id)->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'price' => $request->price,

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
        $psychologicalcounseling = psychologicalcounseling::where('id',$id)->delete();
    }
}
