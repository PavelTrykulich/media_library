<?php

namespace App\Http\Controllers\Admin\Formats;

use App\FormatVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormatVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formats = FormatVideo::all();

        return view('admin.formats.video.index',compact('formats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.formats.video.create');
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
            'title' =>  'required|unique:format_videos||max:20'
        ]);

        FormatVideo::create(['title' => $request->title]);

        return redirect()->route('format_videos.index');
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
        $format = FormatVideo::find($id);
        return view('admin.formats.video.edit',compact('format'));
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
            'title' =>  'required|unique:format_videos||max:20'
        ]);

        $format = FormatVideo::find($id);
        $format->update(['title' => $request->title]);
        return redirect()->route('format_videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FormatVideo::find($id)->delete();
        return redirect()->route('format_videos.index');
    }
}
