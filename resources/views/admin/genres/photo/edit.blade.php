@extends('admin.layouts.layout')

@section('content')
    <div class="container">
        <h3>Edit format - {{$genre->title}}</h3>
        @include('admin.errors')
        <div class="row">
            <div class="col-md-12">
                <form action="{{Route('genre_photos.update',$genre->genre_photo_id)}}"  method="post" >
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" value="{{$genre->title}}">
                        <br>
                        <button class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection