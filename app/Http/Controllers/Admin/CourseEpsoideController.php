<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Request as FRequest;
use Illuminate\Http\Request;
use App\course_epsoide;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
use Storage;
class CourseEpsoideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(course_epsoide::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,FRequest $frequest)
    {
        /** Image Modefy */
        $image = $request->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/course_epsoide/').$fileNameimage);


        // Video Create
        $file = $frequest::file('video');
        $filename = $file->getClientOriginalName();
        $path = public_path().'/video/';
        $file->move($path, $filename);
        /** Video Create */
        // $filenameWithExtension = Carbon::now()->timestamp.$frequest::file('video')->getClientOriginalName();
        // $video = $frequest::file('video');
        // Storage::disk('local')->put('/videos/', $video);
        // Storage::disk('s3')->put($filenameWithExtension, fopen($video, 'r+'));
        // $url = Storage::disk('s3')->url($filenameWithExtension);
        // $video->move(public_path('video'), $filenameWithExtension);
        

        /** Save */
        $input = $request->all();
        $course_epsoide = course_epsoide::create([
            'name_ar' => $input['name_ar'],
            'name_en' => $input['name_en'],
            'description_ar' => $input['description_ar'],
            'description_en' => $input['description_en'],
            'duration' => $input['duration'],
            'image' => 'images/course_epsoide/'.$fileNameimage,
            'video' => 'video/'.$filename,
            'course_id' => $input['course_id']
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        course_epsoide::where('id',$id)->delete();
    }
}
