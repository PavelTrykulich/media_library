<?php

namespace App\Http\Controllers\Author\Files;

use App\File;
use App\Audio;
use App\GenreAudio;
use App\FormatAudio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audios = File::where('type_file','audio')->where('user_id',Auth::id())->get();
        return view('author.files.audio.index',compact('audios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = GenreAudio::all();
        return view('author.files.audio.create')->with('genres',$genres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $formats = FormatAudio::all();
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
            'path_to_file' =>  'mimes:' . "$formats_validate",
        ]);

        $file_audio = $request->file('path_to_file');
        $file_name = time(). $request->title .'.'. $file_audio->extension();
        $file_audio->storeAs('public/files/audios',$file_name);

        $file = File::create([
            'type_file' => 'audio',
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'path_to_file' => $file_name,
            'size' => $file_audio->getSize(),
            'user_id' => Auth::id()
        ]);

        $format_audio = FormatAudio::where('title',$file_audio->extension())->first();

        $audio = new Audio([
            'file_id' => $file->id,
            'format_audio_id' => $format_audio->id,]);

        $file->audio()->save($audio);
        $audio->genres()->sync($request->genres);

        return redirect()->route('audio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $audio = File::where('id',$id)->where('user_id',Auth::id())->first();
        return view('author.files.audio.show',compact('audio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audio = File::find($id);
        $genres = GenreAudio::all();
        $genres_checked = $audio->audio->genres->pluck('id')->toArray();
        return view('author.files.audio.edit',compact('audio','genres','genres_checked'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' =>  "required|unique:files,title,$id",
            'description' =>  'required',
            'short_description' =>  'required',
        ]);

        $audio = File::where('id',$id)->where('user_id',Auth::id())->first();
        $audio->update([
            'type_file' => 'audio',
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'user_id' => Auth::id()
        ]);

        $audio->audio->genres()->sync($request->genres);
        return redirect()->route('audio.index');
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
        return redirect()->route('audio.index');
    }


}
