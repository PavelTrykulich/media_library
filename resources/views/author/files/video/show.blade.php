@extends('layouts.app')

@section('content')
    <div class="align-content-center">

            <h1>{{$video->type_file}}</h1>
            <h1>{{$video->title}}</h1>
            <h1>{{$video->description}}</h1>
            <h1>{{$video->short_description}}</h1>
            <h1>{{$video->size}}</h1>

        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="{{\Illuminate\Support\Facades\Storage::url('files/videos/'.$video->path_to_file)}}" allowfullscreen></iframe>
        </div>
    </div>

    <a href="{{Route('video.edit',$video->id)}}" class="btn btn-warning">Update</a>

    <form action="{{Route('video.destroy',$video->id)}}"  method="post" class="btn" >
        @method('delete')
        @csrf
        <button class="btn btn-danger">Delete</button>

@endsection