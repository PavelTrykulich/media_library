<?php

namespace App\Http\Controllers;

use App\FormatAudio;
use App\FormatPhoto;
use App\FormatVideo;
use App\GenreAudio;
use App\GenrePhoto;
use App\GenreVideo;
use App\File;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    public function index(){

        $files = File::orderBy('created_at','desc')->paginate(9);
        $topThreeFiles =File::selectRaw('files.*, avg(ratings.rating) as avr')
            ->join('ratings','ratings.file_id','=','files.id')
            ->groupBy('files.id')
            ->orderBy('avr','desc')
            ->limit(3)
            ->get();


        return view('welcome',compact('files','topThreeFiles'));
    }

    public function showFile($id){
        $file = File::find($id);
        return view('file.show',compact('file'));
    }

    public function filesByGenre($type,$genre){
        $title = $genre;
        $files = File::genreForSelect($type,$genre)->paginate(9);
        return view('filesScope',compact('files','title'));

    }

    public function filesByFormat($type,$format){
            $title = $format;
            $files = File::formatForSelect($type,$format)->paginate(9);
            return view('filesScope',compact('files','title'));
    }

    public function filesByName(Request $request){
        $title = $request->name;
        $files = File::where('title','ILIKE','%'. $title . '%')->paginate(9);
        return view('filesScope',compact('files','title'));
    }

    public function showGenres(){
        $audios = GenreAudio::all();
        $photos = GenrePhoto::all();
        $videos = GenreVideo::all();
        return view('genres',compact('audios','photos','videos'));
    }

    public function showFormats(){
        $audios = FormatAudio::all();
        $photos = FormatPhoto::all();
        $videos = FormatVideo::all();
        return view('formats',compact('audios','photos','videos'));
    }

    public function filesByType($type){
        $title = ucfirst($type);
        $files = File::where('type_file',$type)->paginate(9);
        return view('filesScope',compact('files','title'));
    }

    public function allFiles(){
        $files = File::orderBy('created_at','desc')->paginate(9);
        return view('file.index',compact('files'));
    }





}
