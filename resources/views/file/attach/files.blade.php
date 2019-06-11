@extends('layouts.app')


@section('content')

    <main role="main">
        <div class="album py-5 bg-light">
            <div class="container">
                @if($files !== 0)

                <h1 class="jumbotron-heading text-center ">Attached files</h1>

                <div class="row">
                    @foreach($files as $file)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">

                                @if ($file->file->getType() == 'audio')
                                    @if($file->file->audio->photos->isNotEmpty())
                                        <img class="card-img-top" src="{{$file->file->getPathToPhotoForAudio()}}" alt="Card image cap">
                                    @else
                                        <img class="card-img-top" src="http://www.mrgood1.com/web/img/thumb.jpg" alt="Card image cap">
                                    @endif
                                    <br>
                                    <audio controls style="width: 600px;" class="col-12">
                                        <source src="{{$file->file->getPathToFile()}}">
                                    </audio>
                                @elseif ($file->file->getType() == 'photo')
                                    <img class="card-img-top" src="{{$file->file->getPathToFile()}}" alt="Card image cap">
                                @else
                                    {{-- @if($file->video->photos->isNotEmpty())
                                         <img class="card-img-top" src="{{$file->getPathToPhotoForVideo()}}" alt="Card image cap">
                                     @else--}}
                                    <video width="349"  controls>
                                        <source src="{{$file->file->getPathToFile()}}" type="video/mp4">
                                    </video>
                                    {{--  @endif--}}
                                @endif



                                <div class="card-body">
                                    <h4 class="font-weight-bold">{{$file->file->title}}</h4>
                                    <p>Author: <a href="{{Route('author.show',$file->file->user_id)}}">{{$file->file->user->getFullNameUser()}}</a></p>
                                    <p class="card-text">{{$file->file->short_description}}</p>

                                    <small class="text-muted">
                                        @if($file->file->getGenres()->isNotEmpty() )
                                            <p>Genres:
                                                @foreach($file->file->getGenres() as $genre)
                                                    <a  href="{{Route('files.genre',['type' => $file->file->getType(),'genre' => trim($genre->title)])}}">{{$genre->title}}</a>
                                                    @if($genre !== $file->file->getGenres()->last())
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
                                            <a type="button" class="btn btn-sm btn-primary " href="{{Route('files.show',$file->file->id)}}">View</a>
                                        </div>
                                        <div class="btn-group">

                                            @if($file->file->ratings->isNotEmpty())
                                                <img src="http://pngimg.com/uploads/star/star_PNG41469.png" height="20" width="20"
                                                     alt="Это абсолютный адрес размещения изображения">
                                                {{$file->file->avgRatingFile()}}
                                            @endif
                                        </div>
                                        <small class="text-muted">
                                            @isset($file->file->created_at)
                                                {{$file->file->created_at->format('d.m.Y')}}
                                            @endisset
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                    @else
                    <h1 class="jumbotron-heading text-center ">No attached files</h1>
                    @endif
            </div>

        </div>
    </main>

@endsection
