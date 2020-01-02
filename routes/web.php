<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', function () {
//    return view('show');
//});
Route::get("/login", "LoginController@login");
Route::post("/in_login", "LoginController@in_login")->name('posts.in_login');


    Route::get("/createMsql", "CommentController@createMsql");

//新增
    Route::get("/add", "CommentController@add");
    Route::post("/create", "CommentController@create");

//页面
    Route::get("/list", "CommentController@list");

    Route::get("/show", "CommentController@show");

//编辑
    Route::get("/edit", "CommentController@edit");
    Route::post("/save", "CommentController@save");

//删除
    Route::post("/delete", "CommentController@delete");



    Route::get("/logout", "CommentController@logout");


