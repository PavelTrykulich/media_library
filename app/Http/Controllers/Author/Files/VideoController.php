<?php

namespace App\Http\Controllers\Author\Files;

use App\File;
use App\Video;
use App\FormatVideo;
use App\GenreVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = File::where('type_file','video')->where('user_id',Auth::id())->get();
        return view('author.files.video.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = GenreVideo::all();
        return view('author.files.video.create')->with('genres',$genres);
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
        $formats = FormatVideo::all();
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

        $file_video = $request->file('path_to_file');
        $file_name = time(). $request->title .'.'. $file_video->extension();
        $file_video->storeAs('public/files/videos',$file_name);

        $file = File::create([
            'type_file' => 'video',
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'path_to_file' => $file_name,
            'size' => $file_video->getSize(),
            'user_id' => Auth::id()
        ]);

        $format_video = FormatVideo::where('title',$file_video->extension())->first();

        $video = new Video([
            'file_id' => $file->id,
            'format_video_id' => $format_video->id,]);

        $file->video()->save($video);

        $video->genres()->sync($request->genres);

        return redirect()->route('video.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = File::where('id',$id)->where('user_id',Auth::id())->first();
        return view('author.files.video.show',compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = File::find($id);
        $genres = GenreVideo::all();
        $genres_checked = $video->video->genres->pluck('id')->toArray();
        return view('author.files.video.edit',compact('video','genres','genres_checked'));
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

        $video = File::where('id',$id)->where('user_id',Auth::id())->first();
        $video->update([
            'type_file' => 'video',
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'user_id' => Auth::id()
        ]);

        $video->video->genres()->sync($request->genres);
        return redirect()->route('video.index');
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
        return redirect()->route('video.index');
    }
}
