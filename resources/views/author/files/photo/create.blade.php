@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Create Photo</h3>
        @include('admin.errors')
        <div class="row">
            <div class="col-md-12">
                <form action="{{Route('photo.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>title</label>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}">
                        <br>
                        <label>description</label>
                        <input type="text" class="form-control" name="description">
                        <br>
                        <label>short_description</label>
                        <input type="text" class="form-control" name="short_description">
                        <br>
                        <label>path_to_file</label>
                        <input type="file" name="path_to_file">
                        <br>
                        <label>Genres</label>


                            @foreach($genres as $genre)
                                <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$genre->title }}" name='genres[]' value="{{$genre->id}}">
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