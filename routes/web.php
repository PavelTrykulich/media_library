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

//Guest

Auth::routes();
Route::get('/', 'SiteController@index');

Route::get('/allFiles', 'SiteController@allFiles')->name('all.files');
Route::get('/authors', 'Author\AuthorController@index')->name('authors');
Route::get('/authors/{id}', 'Author\AuthorController@show')->name('author.show');

/*Route::put('author/file/{file_id}/comment','Author\CommentController@store');
Route::delete('author/file/{file_id}/comment','Author\CommentController@destroy');

Route::post('author/rating/file/{file_id}','Author\RatingController@store')->name('set.rating');
Route::delete('author/rating/file/{file_id}','Author\RatingController@destroy')->name('delete.rating');*/

Route::get('/attached/files/{id}', 'Author\FileController@attachedFiles')->name('getAttachedFiles');

//audio for photo
Route::get('/author/file/{id}/photo/attach/audio', 'Author\FileController@showAudioForPhoto')->name('show.audioForPhoto');
//Route::put('/authors/file/{id}/photo/attach/audio', 'Author\FileController@attachAudioForPhoto')->name('attach.audioForPhoto');

//video for photo
Route::get('/author/file/{id}/photo/attach/video', 'Author\FileController@showVideoForPhoto')->name('show.videoForPhoto');
//Route::put('/authors/file/{id}/photo/attach/video', 'Author\FileController@attachVideoForPhoto')->name('attach.videoForPhoto');

//photo for video
Route::get('/author/file/{id}/video/attach/photo', 'Author\FileController@showPhotoForVideo')->name('show.photoForVideo');
//Route::put('/authors/file/{id}/video/attach/photo', 'Author\FileController@attachPhotoForVideo')->name('attach.photoForVideo');

//photo for audio
Route::get('/author/file/{id}/audio/attach/video', 'Author\FileController@showPhotoForAudio')->name('show.photoForAudio');
//Route::put('/authors/file/{id}/audio/attach/video', 'Author\FileController@attachPhotoForAudio')->name('attach.photoForAudio');


Route::get('genre/{type}/{genre}','SiteController@filesByGenre')->name('files.genre');
Route::get('type/{type}','SiteController@filesByType')->name('files.type');

Route::get('format/{type}/{format}','SiteController@filesByFormat')->name('files.format');
Route::get('search/files','SiteController@filesByName')->name('files.searchName');

Route::get('genres','SiteController@showGenres')->name('files.genres');
Route::get('formats','SiteController@showFormats')->name('files.formats');


Route::get('download/file/{id}','Author\FileController@download')->name('files.download');

Route::get('author/files/{id}', 'SiteController@showFile')->name('files.show');


//Author
Route::group(['middleware' => 'auth','namespace' => 'Author','prefix'=>'author'], function()
{
    Route::resource('files','FileController',['except' => ['show','create']]);
    Route::get('files/create/{type}','FileController@create')->name('files.create');

    Route::get('{id}/edit','AuthorController@edit')->name('author.edit');
    Route::put('{id}','AuthorController@update')->name('author.update');

    Route::put('file/{file_id}/comment','CommentController@store');
    Route::delete('file/{file_id}/comment','CommentController@destroy');

    Route::post('rating/file/{file_id}','RatingController@store')->name('set.rating');
    Route::delete('rating/file/{file_id}','RatingController@destroy')->name('delete.rating');

    Route::put('file/{id}/photo/attach/audio', 'FileController@attachAudioForPhoto')->name('attach.audioForPhoto');
    Route::put('file/{id}/photo/attach/video', 'FileController@attachVideoForPhoto')->name('attach.videoForPhoto');
    Route::put('file/{id}/video/attach/photo', 'FileController@attachPhotoForVideo')->name('attach.photoForVideo');
    Route::put('file/{id}/audio/attach/video', 'FileController@attachPhotoForAudio')->name('attach.photoForAudio');
});



//Admin
Route::group(['middleware' => ['web','admin'],'namespace' => 'Admin','prefix'=>'admin'], function()
{
    Route::resource('users','UserController',['except' => ['create','store']]);
    Route::resource('all_files','FileController',['except' => ['create','store']]);
    Route::resource('comments','CommentController',['except' => ['create','store']]);
    Route::get('search/files','FileController@filesByName')->name('admin.files.searchName');

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

    Route::get('/', 'FileController@index')->name('admin.panel');



});


//Route::get('/admin', 'Admin\FileController@index')->name('admin.panel')->middleware(['auth','admin']);













