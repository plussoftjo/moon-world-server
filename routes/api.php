<?php

use Illuminate\Http\Request;

Route::post('user/login','Api\AuthController@login');
Route::post('user/register','Api\AuthController@register');


/** psychologicalcounseling Controller */
Route::get('psychologicalcounseling/index','Api\psychologicalcounselingController@index');

/** Course Controller */
Route::get('course/index','Api\CourseController@index');

/** Quiz Controller */
Route::get('quiz/index','Api\QuizController@index');
Route::post('quiz/store_awnser','Api\QuizController@store_awnser');


/**  Chat Controller */
Route::post('message/admin/send','Api\ChatController@store_admin_message');

/** ShopController */
Route::get('shop/index','Api\ShopController@index');

Route::post('shop/cart/store','Api\ShopOrderController@store');

/** PayController */
Route::post('pay/pay','Api\PayController@pay');


// Video player
Route::get('videoplayer/{id}','Api\CourseController@play_epsoide');


/** Moon World - admin Api */
/**Login */
Route::post('moonadmin/user/login','ApiAdmin\AuthController@_login');

/** Main Page */
/** ====== Charts ====== */
Route::get('moonadmin/chart/day/user','ApiAdmin\ChartController@getDayData_user');

/** Dashboard */
Route::get('moonadmin/dashboard/index_count','ApiAdmin\DashboardController@index_count');

/** Sectiona */
Route::get('moonadmin/sectiona/index','ApiAdmin\SectionaController@index');
Route::get('moonadmin/sectiona/show/{id}','ApiAdmin\SectionaController@show');
/** Chat Controller */
Route::get('moonadmin/sectiona/message/index/{id}','ApiAdmin\ChatController@index');
Route::post('moonadmin/sectiona/message/send','ApiAdmin\ChatController@send');

/** Course Controller */
Route::get('moonadmin/course/index','ApiAdmin\CourseController@index');
Route::get('moonadmin/course/show/{id}','ApiAdmin\CourseController@show');

/** Store Controller */
Route::get('moonadmin/stores/index','ApiAdmin\StoreController@index');
Route::get('moonadmin/stores/show/{id}','ApiAdmin\StoreController@show');
Route::get('moonadmin/stores/complate_order/{id}','ApiAdmin\StoreController@complate_order');

/** Quiz Controller  */
Route::get('moonadmin/quiz/index','ApiAdmin\QuizController@index');
Route::get('moonadmin/quiz/show/{id}','ApiAdmin\QuizController@show');
Route::post('moonadmin/quiz/complate_order/{id}','ApiAdmin\QuizController@complate_order');




/** ======== Auth Route ========== */

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user/index','Api\AuthController@index');


    /** Chat message */
    Route::post('message/user/send','Api\ChatController@store_user_message');
    Route::post('message/user/get','Api\ChatController@fetch_user_message');

});



    /** MOON WORLD _ADMIN API */
    Route::get('moonadmin/user/auth','ApiAdmin\AuthController@_auth');


/** Test Controller  */
Route::get('test/_test_chart','TestController@getMonthlyPostData');
