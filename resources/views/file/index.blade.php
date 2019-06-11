@extends('layouts.app')


@section('content')
    <div class="album py-5 bg-light">
        <div class="container">

            <h1 class="jumbotron-heading text-center ">All files</h1>

            <div class="row">

                @foreach($files as $file)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">

                            @if ($file->getType() == 'audio')
                                @if($file->audio->photos->isNotEmpty())
                                    <img class="card-img-top" src="{{$file->getPathToPhotoForAudio()}}" alt="Card image cap">
                                @else
                                    <img class="card-img-top" src="http://www.mrgood1.com/web/img/thumb.jpg" alt="Card image cap">
                                @endif
                                <br>
                                <audio controls style="width: 600px;" class="col-12">
                                    <source src="{{$file->getPathToFile()}}">
                                </audio>
                            @elseif ($file->getType() == 'photo')
                                <img class="card-img-top" src="{{$file->getPathToFile()}}" alt="Card image cap">
                            @else
                                {{-- @if($file->video->photos->isNotEmpty())
                                     <img class="card-img-top" src="{{$file->getPathToPhotoForVideo()}}" alt="Card image cap">
                                 @else--}}
                                <video width="349"  controls>
                                    <source src="{{$file->getPathToFile()}}" type="video/mp4">
                                </video>
                                {{--  @endif--}}
                            @endif



                            <div class="card-body">
                                <h4 class="font-weight-bold">{{$file->title}}</h4>
                                <p>Author: <a href="{{Route('author.show',$file->user_id)}}">{{$file->user->getFullNameUser()}}</a></p>
                                <p class="card-text">{{$file->short_description}}</p>

                                <small class="text-muted">
                                    @if($file->getGenres()->isNotEmpty() )
                                        <p>Genres:
                                            @foreach($file->getGenres() as $genre)
                                                <a  href="{{Route('files.genre',['type' => $file->getType(),'genre' => trim($genre->title)])}}">{{$genre->title}}</a>
                                                @if($genre !== $file->getGenres()->last())
                                                    {{','}}
                                                @endif
                                            @endforeach
                                        </p>
                                    @else
                                        <p>Without genre</p>
                                    @endif
                                </small>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-sm btn-primary " href="{{Route('files.show',$file->id)}}">View</a>
                                    </div>
                                    <div class="btn-group">

                                        @if($file->ratings->isNotEmpty())
                                            <img src="http://pngimg.com/uploads/star/star_PNG41469.png" height="20" width="20"
                                                 alt="Это абсолютный адрес размещения изображения">
                                            {{$file->avgRatingFile()}}
                                        @endif
                                    </div>
                                    <small class="text-muted">
                                        @isset($file->created_at)
                                            {{$file->created_at->format('d.m.Y')}}
                                        @endisset
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="pagination row justify-content-center">
            {{$files->links()}}
        </div>
    </div>
@endsection