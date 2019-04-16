<?php

namespace App\Http\Controllers\Author\Files;

use App\File;
use App\Photo;
use App\FormatPhoto;
use App\GenrePhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = File::where('type_file','photo')->where('user_id',Auth::id())->get();
        return view('author.files.photo.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = GenrePhoto::all();
        return view('author.files.photo.create')->with('genres',$genres);
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
        $formats = FormatPhoto::all();
        $formats_validate = '';
        foreach ($formats as $format){
            if(!empty($formats_validate)) $formats_validate.=',';
            $formats_validate.=$format->title;
        }
        $formats_validate = str_replace(' ','',mb_strtolower($formats_validate));

        $this->validate($request, [
            'title' =>  'required|unique:files',
            'description' =>  'required',
            'short_description' =>  'required',
            'path_to_file' =>  'mimes:' . $formats_validate,
        ]);

        $file_photo = $request->file('path_to_file');
        $file_name = time(). $request->title .'.'. $file_photo->extension();
        $file_photo->storeAs('public/files/photos',$file_name);

        $file = File::create([
            'type_file' => 'photo',
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'path_to_file' => $file_name,
            'size' => $file_photo->getSize(),
            'user_id' => Auth::id()
        ]);

        $format_photo = FormatPhoto::where('title',$file_photo->extension())->first();

        $photo = new Photo([
            'file_id' => $file->id,
            'format_photo_id' => $format_photo->id,]);

        $file->audio()->save($photo);
        $photo->genres()->sync($request->genres);

        return redirect()->route('photo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = File::where('id',$id)->where('user_id',Auth::id())->first();
        return view('author.files.photo.show',compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = File::find($id);
        $genres = GenrePhoto::all();
        $genres_checked = $photo->photo->genres->pluck('id')->toArray();
        return view('author.files.photo.edit',compact('photo','genres','genres_checked'));
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
            'title' =>  "required|unique:files,title,$id",
            'description' =>  'required',
            'short_description' =>  'required',
        ]);

        $photo = File::where('id',$id)->where('user_id',Auth::id())->first();
        $photo->update([
            'type_file' => 'photo',
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'user_id' => Auth::id()
        ]);

        $photo->photo->genres()->sync($request->genres);
        return redirect()->route('photo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        File::where('id',$id)->where('user_id',Auth::id())->first()->delete();
        return redirect()->route('photo.index');
    }
}
