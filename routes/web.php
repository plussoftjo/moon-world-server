<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/adminp', function () {
    return view('admin');
});

Route::get('/checkout', function () {
    return view('checkout');
});


/** Admin panel Controller */

/** psychologicalcounseling Controller */
Route::post('/admin/psychologicalcounseling/store','Admin\PsychologicalCounselingController@store');
Route::get('/admin/psychologicalcounseling/index','Admin\PsychologicalCounselingController@index');
Route::get('/admin/psychologicalcounseling/remove/{id}','Admin\PsychologicalCounselingController@destroy');
Route::get('/admin/psychologicalcounseling/show/{id}','Admin\PsychologicalCounselingController@show');
Route::post('/admin/psychologicalcounseling/updateImage/{id}','Admin\PsychologicalCounselingController@updateImage');
Route::post('/admin/psychologicalcounseling/update/{id}','Admin\PsychologicalCounselingController@update');


/** Courses Controller */
Route::post('/admin/course/store','Admin\CourseController@store');
Route::get('/admin/course/index','Admin\CourseController@index');
Route::get('/admin/course/show/{id}','Admin\CourseController@show');
Route::post('/admin/course/updateImage/{id}','Admin\CourseController@updateImage');
Route::post('/admin/course/update/{id}','Admin\CourseController@update');
Route::get('/admin/course/remove/{id}','Admin\CourseController@destroy');

/** Course Epsoide Controler  */
Route::post('/admin/course/epsoide/store','Admin\CourseEpsoideController@store');
Route::get('/admin/course/epsoide/index','Admin\CourseEpsoideController@index');
Route::get('/admin/course/epsoide/remove/{id}','Admin\CourseEpsoideController@destroy');

/** Quiz Controller */
Route::post('/admin/quiz/store','Admin\QuizController@store');
Route::get('/admin/quiz/index','Admin\QuizController@index');
Route::get('/admin/quiz/show/{id}','Admin\QuizController@show');
Route::post('/admin/quiz/updateImage/{id}','Admin\QuizController@updateImage');
Route::post('/admin/quiz/update/{id}','Admin\QuizController@update');
Route::get('/admin/quiz/remove/{id}','Admin\QuizController@destroy');
Route::post('/admin/quiz/question/store','Admin\QuizQuestionController@store');
Route::get('/admin/quiz/question/remove/{id}','Admin\QuizQuestionController@destroy');

/** Shop Category Controller */
Route::post('/admin/shop_category/store','Admin\ShopCategoryController@store');
Route::get('/admin/shop_category/index','Admin\ShopCategoryController@index');
Route::get('/admin/shop_category/delete/{id}','Admin\ShopCategoryController@destroy');
Route::get('/admin/shop_category/show/{id}','Admin\ShopCategoryController@show');
Route::post('/admin/shop_category/updateImage/{id}','Admin\ShopCategoryController@updateImage');
Route::post('/admin/shop_category/update/{id}','Admin\ShopCategoryController@update');

/** Shop Items Controller */
Route::post('/admin/shop_items/store','Admin\ShopItemController@store');
Route::get('/admin/shop_items/index','Admin\ShopItemController@index');
Route::get('/admin/shop_items/delete/{id}','Admin\ShopItemController@destroy');
Route::get('/admin/shop_items/show/{id}','Admin\ShopItemController@show');
Route::post('/admin/shop_items/updateImage/{id}','Admin\ShopItemController@updateImage');
Route::post('/admin/shop_items/update/{id}','Admin\ShopItemController@update');


/** Store Controller */
Route::get('admin/store/index_order','Admin\StoreController@index_order');
Route::get('admin/store/order/show/{id}','Admin\StoreController@show_order');
Route::get('admin/store/order/vertify/{id}','Admin\StoreController@vertify');
Route::get('admin/store/overview','Admin\StoreController@overview');


/** Report Controller */
Route::get('admin/report/sectiona','Admin\ReportController@sectiona_index');
Route::get('admin/report/course','Admin\ReportController@course_index');
Route::get('admin/report/shop','Admin\ReportController@shop_index');
Route::get('admin/report/quiz','Admin\ReportController@quiz_index');

/** Process Controller */
Route::get('admin/process/sectiona','Admin\ProcessController@sectiona_index');
Route::get('admin/process/sectiona/show/{id}','Admin\ProcessController@sectiona_show');
Route::get('admin/process/sectiona/fetch_messages/{id}','Admin\ProcessController@sectiona_fetch_message');
Route::post('admin/process/sectiona/admin_send_message','Admin\ProcessController@admin_send_message');
Route::get('admin/process/sectiona/change_state/{id}','Admin\ProcessController@sectiona_change_state');

//Process -> Quiz
Route::get('admin/process/quiz','Admin\ProcessController@quiz_index');
Route::get('admin/process/quiz/show/{id}','Admin\ProcessController@quiz_show');
Route::post('admin/process/quiz/send_result','Admin\ProcessController@quiz_send_result');


Route::get('admin/users/index','Admin\UserController@index');