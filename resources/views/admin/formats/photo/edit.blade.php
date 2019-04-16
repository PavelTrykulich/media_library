@extends('admin.layouts.layout')

@section('content')
    <div class="container">
        <h3>Edit format - {{$format->title}}</h3>
        @include('admin.errors')
        <div class="row">
            <div class="col-md-12">
                <form action="{{Route('format_photos.update',$format->id)}}"  method="post" >
                    @method('put')
                    @csrf

                    <div class="form-group">
                        <input type="text" class="form-control" name="title" value="{{$format->title}}">
                        <br>
                        <button class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection