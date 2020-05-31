<?php


Route::get('/home','HomeController@index');
Route::get('/','Backend\SampleController@index')->name('home');
Route::get('/welcome','Backend\SampleController@welcome');
Route::get('/posts','Backend\SampleController@posts');
Route::get('/registers','Backend\SampleController@showRegistrationForm')->name('registers');
Route::post('/registers','Backend\SampleController@processRegistration');





//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'],function(){
    Route::get('/dashboard','AuthController@Dashboard')->name('dashboard');

});


Route::get('/registration','AuthController@showRegistration')->name('registration');
Route::post('/registration','AuthController@processRegistration');


Route::get('/userlogin','AuthController@showLogin')->name('userlogin');
Route::post('/userlogin','AuthController@processLogin');

Route::get('/userProfile','AuthController@showUser')->name('userProfile');
Route::get('/userLogout','AuthController@logout')->name('userLogout');

//mail verify
Route::get('/verify/{token}','AuthController@verifyEmail')->name('verify');

//category

Route::get('/categories','Backend\CategoryController@index')->name('categories.index');
Route::get('/categories/add','Backend\CategoryController@create')->name('categories.create');
Route::post('/categories','Backend\CategoryController@store')->name('categories.store');
Route::get('/categories/{id}','Backend\CategoryController@show')->name('categories.show');
Route::get('/categories/{id}/edit','Backend\CategoryController@edit')->name('categories.edit');
Route::put('/categories/{id}','Backend\CategoryController@update')->name('categories.update');
Route::delete('/categories/{id}','Backend\CategoryController@delete')->name('categories.delete');


//posts

Route::resource('/posts','Backend\PostsController');



