@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Create audio</h3>
        @include('admin.errors')
        <div class="row">
            <div class="col-md-12">
                <form action="{{Route('video.update',$video->id)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf

                    <div class="form-group">

                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{\Illuminate\Support\Facades\Storage::url('files/videos/'.$video->path_to_file)}}" allowfullscreen></iframe>
                        </div>

                        <label>title</label>
                        <input type="text" class="form-control" name="title" value="{{$video->title}}">
                        <br>
                        <label>description</label>
                        <input type="text" class="form-control" name="description" value="{{$video->title}}">
                        <br>
                        <label>short_description</label>
                        <input type="text" class="form-control" name="short_description" value="{{$video->title}}">
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