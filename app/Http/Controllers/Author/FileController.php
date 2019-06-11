<?php

namespace App\Http\Controllers\Author;


use App\File;
use App\Audio;
use App\Photo;
use App\Video;
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


/**
 * @method validate(Request $request, array $array)
 */
class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::where('user_id',Auth::id())->paginate(9);
        return view('author.files.index',compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        switch (trim($type)){
            case 'audio':
                $genres = GenreAudio::all();
                break;
            case 'photo':
                $genres = GenrePhoto::all();
                break;
            case 'video':
                $genres = GenreVideo::all();
                break;
        }
        return view('file.create',compact('genres','type'));

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
        switch (trim($request->type_file)){
            case 'audio':
                $formats = FormatAudio::all();
                break;
            case 'photo':
                $formats = FormatPhoto::all();
                break;
            case 'video':
                $formats = FormatVideo::all();
                break;
        }

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

        //store file
        $usersFile = $request->file('path_to_file');
        $file_name = time(). $request->title .'.'. $usersFile->extension();
        $usersFile->storeAs('public/files/' . trim($request->type_file) . 's',$file_name);

        /*switch (str_replace(' ','',$request->type_file)){
            case 'audio':
                $file->storeAs('public/files/audios',$file_name);
                break;
            case 'photo':
                $file->storeAs('public/files/photos',$file_name);
                break;
            case 'video':
                $file->storeAs('public/files/videos',$file_name);
                break;
        }*/

        $file = File::create([
            'type_file' => $request->type_file,
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'path_to_file' => $file_name,
            'size' => $usersFile->getSize(),
            'user_id' => Auth::id()
        ]);
        //create other models
        switch (trim($request->type_file)){
            case 'audio':
                $format_audio = FormatAudio::where('title',$usersFile->extension())->first();
                $audio = new Audio([
                    'file_id' => $file->id,
                    'format_audio_id' => $format_audio->id,
                    ]);
                $file->audio()->save($audio);
                $audio->genres()->sync($request->genres);
                break;
            case 'photo':
                $format_photo = FormatPhoto::where('title',$usersFile->extension())->first();
                $photo = new Photo([
                    'file_id' => $file->id,
                    'format_photo_id' => $format_photo->id,
                    ]);
                $file->photo()->save($photo);
                $photo->genres()->sync($request->genres);
                break;
            case 'video':
                $format_video = FormatVideo::where('title',$usersFile->extension())->first();

                $video = new Video([
                    'file_id' => $file->id,
                    'format_video_id' => $format_video->id,
                ]);
                $file->video()->save($video);
                $video->genres()->sync($request->genres);
                break;
        }
        return redirect()->route('author.show',Auth::id());
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
        return view('file.show',compact('file'));
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
        return view('file.edit',compact('file','genres','genres_checked'));
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

        $file = File::where('id',$id)->where('user_id',Auth::id())->first();
        $file->update([
            'type_file' => $request->type_file,
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'user_id' => Auth::id(),

        ]);

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
        return redirect()->route('files.show',$id);


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
        return redirect()->route('author.show',Auth::id());
    }

    public function download($id)
    {
        $file = File::find($id);
        $pathToFile = storage_path('app/public/files/' . $file->getType() . 's/' . $file->path_to_file);
        return response()->download($pathToFile);
    }


    public function showAudioForPhoto($id)
    {
        $files = File::where('type_file','audio')->where('user_id',Auth::id())->get();
        $photo = Photo::where('file_id',$id)->first();
        $checked = $photo->audios->pluck('id')->toArray();
        return view('file.attach.audioForPhoto',compact('files','id','checked'));
    }

    public function attachAudioForPhoto(Request $request,$id)
    {
        $photo = Photo::where('file_id',$id)->first();
        $photo->audios()->sync($request->filesId);
        return redirect()->route('files.show',$id);


    }

    public function showVideoForPhoto($id)
    {
        $files = File::where('type_file','video')->where('user_id',Auth::id())->get();
        $photo = Photo::where('file_id',$id)->first();
        $checked = $photo->videos->pluck('id')->toArray();
        return view('file.attach.videoForPhoto',compact('files','id','checked'));
    }


    public function attachVideoForPhoto(Request $request,$id)
    {
        $photo = Photo::where('file_id',$id)->first();
        $photo->videos()->sync($request->filesId);
        return redirect()->route('files.show',$id);
    }

    public function showPhotoForAudio($id)
    {
        $files = File::where('type_file','photo')->where('user_id',Auth::id())->get();
        $audio = Audio::where('file_id',$id)->first();
        $checked = $audio->photos->pluck('id')->toArray();
        return view('file.attach.photoForAudio',compact('files','id','checked'));
    }

    public function attachPhotoForAudio(Request $request,$id)
    {
        $audio = Audio::where('file_id',$id)->first();
        $audio->photos()->sync($request->filesId);
        return redirect()->route('files.show',$id);
    }

    public function showPhotoForVideo($id)
    {
        $files = File::where('type_file','photo')->where('user_id',Auth::id())->get();
        $video = Video::where('file_id',$id)->first();

        $checked = $video->photos->pluck('id')->toArray();

        return view('file.attach.photoForVideo',compact('files','id','checked'));
    }


    public function attachPhotoForVideo(Request $request,$id)
    {
        $video = Video::where('file_id',$id)->first();
        $video->photos()->sync($request->filesId);
        return redirect()->route('files.show',$id);
    }

    public function attachedFiles($id)
    {
        $file = File::find($id);
        $files = $file->getAttachedFiles();
       // dd($files);
        return view('file.attach.files',compact('files'));
    }


}
