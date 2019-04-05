<?php

namespace App\Http\Controllers\Admin\Genres;

use App\GenreVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenreVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = GenreVideo::all();
        return view('admin.genres.video.index',compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genres.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>  'required|unique:genre_videos||max:20'
        ]);

        GenreVideo::create(['title'=>$request->title]);
        return redirect()->route('genre_videos.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genre = GenreVideo::find($id);
        return view('admin.genres.video.edit',compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' =>  'required|unique:genre_videos||max:20'
        ]);

        $genre = GenreVideo::find($id);
        $genre->update(['title'=>$request->title]);
        return redirect()->route('genre_videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GenreVideo::find($id)->delete();
        return redirect()->route('genre_videos.index');
    }
}
