@extends('layouts.app')

@section('content')

    <div class="container">
        <br>
        <h3 class="text-center">Create {{$type}}</h3>
        @include('admin.errors')
        <div class="row">
            <div class="col-md-12">
                <form action="{{Route('files.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title">
                        <br>
                        <label>Short description</label>
                        <textarea type="text" class="form-control" name="short_description"></textarea>
                        <br>
                        <label>Description</label>
                        <textarea type="text" class="form-control" name="description"></textarea>
                        <br>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">{{ucfirst($type) }} file</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="path_to_file">
                        </div>
                        <input type="hidden" name="type_file" value="{{$type}}">
                        <br>
                        <label>Genres</label>

                      @foreach($genres as $genre)
                             <div class="custom-control custom-checkbox">
                                 <input type="checkbox" class="custom-control-input" id="{{$genre->title }}" name='genres[]' value="{{$genre->id}}">
                                 <label class="custom-control-label" for="{{$genre->title }}" >{{$genre->title }}</label>
                                 <br>
                             </div>
                         @endforeach

                        <br>
                            <button class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection