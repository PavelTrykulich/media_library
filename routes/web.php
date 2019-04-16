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

//Admin
Route::group(['middleware' => 'web','namespace' => 'Admin','prefix'=>'admin'], function()
{
    Route::resource('users','UserController',['except' => ['create','store']]);

    Route::group(['namespace' => 'Files','prefix'=>'files'], function()
    {
        Route::resource('audio_files','AudioController',['except' => ['create','store']]);
        Route::resource('photo_files','PhotoController',['except' => ['create','store']]);
        Route::resource('video_files','VideoController',['except' => ['create','store']]);
    });

    Route::group(['namespace' => 'Formats','prefix'=>'formats'], function()
    {
        Route::resource('format_photos','FormatPhotoController',['except' => ['show']]);
        Route::resource('format_videos','FormatVideoController',['except' => ['show']]);
        Route::resource('format_audios','FormatAudioController',['except' => ['show']]);
    });

    Route::group(['namespace' => 'Genres','prefix'=>'genres'], function()
    {
        Route::resource('genre_photos','GenrePhotoController',['except' => ['show']]);
        Route::resource('genre_videos','GenreVideoController',['except' => ['show']]);
        Route::resource('genre_audios','GenreAudioController',['except' => ['show']]);
    });



});

//Author
Route::group(['middleware' => 'auth','namespace' => 'Author','prefix'=>'author'], function()
{
    Route::resource('file','FileController');

    Route::group(['namespace' => 'Files','prefix'=>'files'], function()
    {
        Route::resource('audio','AudioController');
        Route::resource('photo','PhotoController');
        Route::resource('video','VideoController');
    });

    Route::resource('profile','ProfileController', ['only' => ['update','edit','destroy']]);


});



//Guest

Auth::routes();


Route::get('/authors','AuthorController@index');
Route::get('/authors/show/{id}','AuthorController@show');




Route::get('/admin', function (){
    return view('admin.layouts.layout');
});

//Route::resource('/admin/format_photos','Admin\FormatPhotoController');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/main','SiteController@index');
Route::get('/f','Author\FileController@store');



//Route::get('/home','HomeController@index');


Route::get('/home', 'HomeController@index')->name('home');


