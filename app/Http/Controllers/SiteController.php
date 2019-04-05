<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class SiteController extends Controller
{
    public function index(){
        $files = File::has('video')->first();

       // dd($files);
        //dd($files->photo->genrePhotos);
//$file = File::first();
    //   dd($file->user);
    //    dd($files);
        return view('site.main',compact('files'));
    }
}
