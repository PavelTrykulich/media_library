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

//admin
Route::group(['middleware' => 'web','namespace' => 'Admin','prefix'=>'admin'], function()
{
    Route::group(['namespace' => 'Formats','prefix'=>'formats'], function()
    {
        Route::resource('format_photos','FormatPhotoController');
        Route::resource('format_videos','FormatVideoController');
        Route::resource('format_audios','FormatAudioController');
    });

    Route::group(['namespace' => 'Genres','prefix'=>'genres'], function()
    {
        Route::resource('genre_photos','GenrePhotoController');
        Route::resource('genre_videos','GenreVideoController');
        Route::resource('genre_audios','GenreAudioController');
    });


});





Route::get('/admin', function (){
    return view('admin.layouts.layout');
});

//Route::resource('/admin/format_photos','Admin\FormatPhotoController');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/main','SiteController@index');



Route::get('/home','HomeController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


