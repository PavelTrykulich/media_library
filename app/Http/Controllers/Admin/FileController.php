<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\GenreAudio;
use App\GenrePhoto;
use App\GenreVideo;
use App\FormatAudio;
use App\FormatPhoto;
use App\FormatVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('created_at')->paginate(9);
        return view('admin.file.index',compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::find($id);
        return view('admin.file.show',compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = File::find($id);
        if (Auth::id() != $file->user_id){
            return redirect()->back();
        }

        switch (trim($file->type_file))
        {
            case 'audio':
                $genres = GenreAudio::all();
                $genres_checked = $file->audio->genres->pluck('id')->toArray();
                break;
            case 'photo':
                $genres = GenrePhoto::all();
                $genres_checked = $file->photo->genres->pluck('id')->toArray();
                break;
            case 'video':
                $genres = GenreVideo::all();
                $genres_checked = $file->video->genres->pluck('id')->toArray();
                break;
        }
        return view('admin.file.edit',compact('file','genres','genres_checked'));
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



        $file = File::where('id',$id)->first();

        $file->update([
            'type_file' => $request->type_file,
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
        ]);
        //update genres
        switch (trim($file->type_file))
        {
            case 'audio':
                $file->audio->genres()->sync($request->genres);
                break;
            case 'photo':
                $file->photo->genres()->sync($request->genres);
                break;
            case 'video':
                $file->video->genres()->sync($request->genres);
                break;
        }
        return redirect()->route('all_files.show',$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        File::where('id',$id)->first()->delete();
        return redirect()->route('all_files.index');
    }

    public function filesByType($type){
        $title = ucfirst($type);
        $files = File::where('type_file',$type)->paginate(9);
        return view('filesScope',compact('files','title'));
    }

    public function filesByName(Request $request){
        $title = $request->name;
        $files = File::where('title','ILIKE','%'. $title . '%')->paginate(9);
        return view('admin.file.index',compact('files','title'));
    }

}
