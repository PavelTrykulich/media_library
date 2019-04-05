<?php

namespace App\Http\Controllers\Admin\Genres;

use App\GenrePhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenrePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = GenrePhoto::all();
        return view('admin.genres.photo.index',compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genres.photo.create');
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
            'title' =>  'required|unique:genre_photos||max:20'
        ]);

        GenrePhoto::create(['title' => $request->title]);
        return redirect()->route('genre_photos.index');
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
        $genre = GenrePhoto::find($id);
        return view('admin.genres.photo.edit',compact('genre'));
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
            'title' =>  'required|unique:genre_photos||max:20'
        ]);

        $genre = GenrePhoto::find($id);
        $genre->update(['title' => $request->title]);
        return redirect()->route('genre_photos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GenrePhoto::find($id)->delete();
        return redirect()->route('genre_photos.index');
    }
}
