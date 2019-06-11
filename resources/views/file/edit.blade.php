@extends('layouts.app')


@section('content')

    <div class="container my-5">
        <h3 align="center">Update {{$file->type_file}}</h3>
        @include('admin.errors')
        <div class="row">
            <div class="col-md-12">
                <form action="{{Route('files.update',$file->id)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="form-group">
                        <input type="hidden" name="type_file" value="{{$file->type_file}}">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{$file->title}}">
                        <br>
                        <label>Short description</label>
                        <textarea type="text" class="form-control" name="short_description">{{$file->short_description}}</textarea>
                        <br>
                        <label>Description</label>
                        <textarea type="text" class="form-control" name="description">{{$file->description}}</textarea>
                        <br>


                        <label>Genres</label>


                        @foreach($genres as $genre)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$genre->title }}" name='genres[]' value="{{$genre->id}}"
                                        {{in_array($genre->id,$genres_checked) ? 'checked' : ''}}>
                                <label class="custom-control-label" for="{{$genre->title }}" >{{$genre->title }}</label>
                                <br>
                            </div>
                        @endforeach


                        <button class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection