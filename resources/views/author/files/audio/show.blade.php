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


    @foreach($genres as $genre)
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="{{$genre->title }}" name='genres[]' value="{{$genre->id}}"
                    {{in_array($genre->id,$genres_checked) ? 'checked' : ''}}>
            <label class="custom-control-label" for="{{$genre->title }}" >{{$genre->title }}</label>
            <br>
        </div>
    @endforeach


    <div class="col-sm-8 blog-main">
        <h1>title</h1>
        <div class="comments">
            <ul class="list-group">

                @foreach($comments as $comment)

                    <li class="list-group-item">
                        <strong>
                            {{$comment->text_comment}}
                        </strong>

                        <strong>
                            {{$comment->user->email}}
                        </strong>
                 @if(Auth::id() == $comment->user_id)
                    <form method="post" action="/author/file/{{$comment->id}}/comment">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                 @endif

                    </li>

               @endforeach

            </ul>
        </div>

        {{--add comment--}}
        <hr>
        <div class="card">
            <div class="card-block"></div>
            <form method="post" action="/author/file/{{$audio->id}}/comment">
                @method('put')
                @csrf
                <div class="form-group">
                    <textarea name="text_comment" placeholder="Your comment" class="form-control">

                    </textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add comment</button>
                </div>
            </form>
        </div>
    </div>


    <a href="{{Route('audio.edit',$audio->id)}}" class="btn btn-warning">Update</a>

    <form action="{{Route('audio.destroy',$audio->id)}}"  method="post" class="btn" >
        @method('delete')
        @csrf
        <button class="btn btn-danger">Delete</button>

@endsection