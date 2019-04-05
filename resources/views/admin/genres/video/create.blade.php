@extends('admin.layouts.layout')

@section('content')
    <div class="container">
        <h3>Create format</h3>
        @include('admin.errors')
        <div class="row">
            <div class="col-md-12">
                <form action="{{Route('genre_videos.store')}}" method="post" >
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="title">
                        <br>
                        <button class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection