@extends('layouts.app')


@section('content')

<div class="container modal-dialog-centered justify-content-md-center">
    <div class="row">

        <div class="col-md-4 ">
            <div class="card bg-dark text-light" style="width: 18rem;">
                <div class="card-header">
                    Audio
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($audios as $audio)
                        <li class="list-group-item alert-link"><a href="{{Route('files.genre',['type' => 'audio','genre' => trim($audio->title)])}}">{{$audio->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-dark text-light" style="width: 18rem;">
                <div class="card-header">
                    Photo
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($photos as $photo)
                        <li class="list-group-item alert-link"><a href="{{Route('files.genre',['type' => 'photo','genre' => trim($photo->title)])}}">{{$photo->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card bg-dark text-light" style="width: 18rem;">
                <div class="card-header">
                    Video
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($videos as $video)
                        <li class="list-group-item alert-link"><a href="{{Route('files.genre',['type' => 'video','genre' => trim($video->title)])}}">{{$video->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>





    </div>
</div>
@endsection