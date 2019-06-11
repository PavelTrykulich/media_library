<?php

namespace App\Http\Controllers\Author;

use App\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request,$id)
    {
        Rating::create([
            'rating' => $request->rating,
            'user_id' => Auth::id(),
            'file_id' => $id,
        ]);
        return back();
    }

    public function destroy($id)
    {
        Rating::where('file_id',$id)->where('user_id',Auth::id())->delete();
        return back();
    }
}
