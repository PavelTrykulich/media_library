@extends('layouts.app')


@section('content')
    <main role="main">

        <section>
            <div class="container ">
                <div class="row">
                    <div class="col-md-12 p-5">
                        <div class="jumbotron bg-dark text-light my-5">
                            <h1 class="display-4">Welcome to the Media library!</h1>
                            <h1 class="display-4"></h1>
                            <p class="lead">Browse, rate, comment, download, and add your own media.</p>
                            <hr class="my-4">
                            <p>Have a nice time with us!</p>
                            <a class="btn btn-primary btn-lg" href="{{route('all.files')}}" role="button">All files</a>
                        </div>
                    </div>
                </div>

                <div class="row p-5">
                    <div class="col-md-12  my-5 p-5">

                <h1 class="jumbotron-heading text-center ">Top 3 files</h1>
                <p class="lead text-muted text-center">The best files for user evaluation.</p>

                <div class="row">
                    @foreach($topThreeFiles as $file)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow ">
                                <span class="badge badge-warning">Top file</span>
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
                                    <video width="295"  controls>
                                        <source src="{{$file->getPathToFile()}}" type="video/mp4">
                                    </video>
                                    {{--  @endif--}}
                                @endif



                                <div class="card-body border-secondary mb-3 text-dark">
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
                </div>

            </div>
        </section>

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
    </main>

@endsection
