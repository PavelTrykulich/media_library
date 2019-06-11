@extends('admin.layouts.layout')

@section('content')
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <div class="card mb-3 box-shadow">
                    @if(isset($user->avatar))

                        <img class="card-img-top" width="349" src="{{asset('avatars/' . $user->avatar)}}" alt="Card image cap">
                    @else
                        <img class="card-img-top" src="http://www.mrgood1.com/web/img/thumb.jpg" alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h4>{{$user->getFullNameUser()}}</h4>
                        <p>{{$user->email}}</p>
                        <p>Average rating {{$user->avg_ret_author()}}</p>
                        <p class="card-text">{{$user->short_description}}</p>

                    </div>
                </div>

                    <div class="btn-group " role="group">
                        <a href="{{ Route('users.edit',$user->id)}}" type="button" class="btn btn-warning">Update</a>

                        <form action="{{ Route('users.destroy',$user->id)}}"  method="post"  >
                            @method('delete')
                            @csrf

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>




            </div>


            <div class="col-md-9">
                <div class="col-md-12">
                    <p class="h2" align="center">Information about author</p>
                    <br>
                    <p class="h4" >Full name: {{$user->getFullNameUser() . $user->patronymic}}</p>

                    @isset($user->description)
                        <p class="h4" >Description: {{$user->description}}</p>
                    @endisset

                    @isset($user->date_birth)
                        <p class="h4" >Date of birth: {{$user->date_birth}}</p>
                    @endisset

                    <div class="d-flex justify-content-between align-items-center">
                        <p class="h4">On the site since:
                            @isset($user->created_at)
                                {{$user->created_at->format('d.m.Y')}}
                            @endisset
                        </p>
                    </div>

                </div>
                <BR>
            </div>


        </div>

        @if($topThreeFiles->isNotEmpty())
            <div class="alert " role="alert">
                <p class="h3" align="center">Top files</p>
            </div>
        @endif


        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row ">
                    @foreach($topThreeFiles as $file)
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
                                    <video width="349"  controls>
                                        <source src="{{$file->getPathToFile()}}" type="video/mp4">
                                    </video>
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
        </div>
        @if($files->isNotEmpty())
            <div class="alert " role="alert">
                <p class="h3" align="center">All author`s files</p>
            </div>
        @else
            <div class="alert alert-primary h4 text-center" role="alert">
                The author has no files yet
            </div>

        @endif
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row ">
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
                                            <a type="button" class="btn btn-sm btn-primary " href="{{Route('all_files.show',$file->id)}}">View</a>
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