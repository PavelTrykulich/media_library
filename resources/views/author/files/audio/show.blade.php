@extends('layouts.app')

@section('content')
    <div class="align-content-center">

            <h1>{{$audio->type_file}}</h1>
            <h1>{{$audio->title}}</h1>
            <h1>{{$audio->description}}</h1>
            <h1>{{$audio->short_description}}</h1>
            <h1>{{$audio->size}}</h1>

        <div class="col-sm-4 col-sm-offset-4">
            <audio controls style="width: 600px;">
                <source src="{{\Illuminate\Support\Facades\Storage::url('files/audios/'.$audio->path_to_file)}}">
            </audio>
        </div>
    </div>

    <a href="{{Route('audio.edit',$audio->id)}}" class="btn btn-warning">Update</a>

    <form action="{{Route('audio.destroy',$audio->id)}}"  method="post" class="btn" >
        @method('delete')
        @csrf
        <button class="btn btn-danger">Delete</button>

@endsection