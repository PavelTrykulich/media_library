@extends('layouts.app')

@section('content')
    <div class="align-content-center">

            <h1>{{$photo->type_file}}</h1>
            <h1>{{$photo->title}}</h1>
            <h1>{{$photo->description}}</h1>
            <h1>{{$photo->short_description}}</h1>
            <h1>{{$photo->size}}</h1>

        <img src="{{\Illuminate\Support\Facades\Storage::url('files/photos/'.$photo->path_to_file)}}" alt="..." class="img-thumbnail">

    </div>




    @foreach($genres as $genre)
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="{{$genre->title }}" name='genres[]' value="{{$genre->id}}"
                    {{in_array($genre->id,$genres_checked) ? 'checked' : ''}}>
            <label class="custom-control-label" for="{{$genre->title }}" >{{$genre->title }}</label>
            <br>
        </div>
    @endforeach


    <a href="{{Route('photo.edit',$photo->id)}}" class="btn btn-warning">Update</a>
    <form action="{{Route('photo.destroy',$photo->id)}}"  method="post" class="btn" >
        @method('delete')
        @csrf
        <button class="btn btn-danger">Delete</button>

@endsection