<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\quiz;
use App\quiz_awnser;
use Auth;
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
    public function store_awnser(Request $request)
    {
        $awnser = $request->awnser;
        $rand = rand(10000,1000000);
        foreach ($awnser as $k) {
            $quiz_awnser = quiz_awnser::create([
                'user_id' => $request->user_id,
                'quiz_id' => $request->quiz_id,
                'cid' => $rand,
                'question' => $k['question'],
                'awnser' => $k['value']
            ]);
        }
        
        return response()->json(['msg' => 'success']);
        
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
        //
    }
}
