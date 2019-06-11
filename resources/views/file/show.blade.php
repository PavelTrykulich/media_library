@extends('layouts.app')

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row ">
                    <div class="col-md-9 ">
                        <div class="card mb-4 box-shadow ">
                            @if ($file->getType() == 'audio')
                                @if($file->audio->photos->isNotEmpty())
                                    <img class="card-img" src="{{$file->getPathToPhotoForAudio()}}" alt="Card image cap"  >
                                @else
                                    <img class="card-img-top" src="http://www.mrgood1.com/web/img/thumb.jpg" alt="Card image cap">
                                @endif
                                <br>
                                <audio controls style="width: 600px;" class="col-12 justify-content-center">
                                    <source src="{{$file->getPathToFile()}}">
                                </audio>
                            @elseif ($file->getType() == 'photo')
                                <img class="card-img-top" src="{{$file->getPathToFile()}}" alt="Card image cap">
                            @else
                                <video width="824"  controls>
                                    <source src="{{$file->getPathToFile()}}" type="video/mp4">
                                </video>
                            @endif
                            <div class="card-body">
                                <h2>{{$file->title}}</h2>
                                @if($file->ratings->isNotEmpty())

                                    <p class="h4">
                                        <span class="badge badge-warning">
                                        <img src="http://pngimg.com/uploads/star/star_PNG41469.png" height="15" width="15">
                                        {{$file->avgRatingFile()}}
                                        </span>
                                    </p>
                                @endif
                                <p class="card-text">{{$file->short_description}}</p>
                                <p class="card-text">{{$file->description}}</p>

                                <small class="text-muted">
                                    {{ $file->size ? 'Size:' . ' ' . $file->getSize() : '' }}</small>
                                <br>
                                @if( $file->date_last_eval != null)
                                <small class="text-muted">Date last eval:
                                    {{ $file->date_last_eval}}</small>
                                <br>
                                @endif
                                <small class="text-muted"> Format:

                                    <a  href="{{Route('files.format',['type' => $file->getType(),'format' => trim($file->getFormat())])}}">{{$file->getFormat()}}</a>

                                @if($file->getGenres())
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
                                <small class="text-muted">
                                    <a  href="{{Route('files.download', $file->id)}}">Download</a>

                                </small>


                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        @isset($file->created_at)
                                            {{$file->created_at->format('d.m.Y')}}
                                        @endisset
                                    </small>
                                </div>
                            </div>
                        </div>

                        @if($file->user_id == Auth::id())

                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <a  href="{{Route('files.edit',$file->id)}}" type="submit" class="btn btn-info"  >Update file</a>
                                        </div>
                                        <div class="col-md-2">
                                            <form method="post" action="{{Route('files.destroy',$file->id)}}   ">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete file</button>
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            @if($file->getType() == 'photo')

                                                <a class="btn-secondary dropdown-toggle nav-link active" href="#"  id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" >
                                                    Attach
                                                </a>
                                                <div class="dropdown-menu " aria-labelledby="dropdownMenuLink" aria-haspopup="true" >
                                                    <a  href="{{Route('show.audioForPhoto',$file->id)}}" class="dropdown-item" > Audio</a>
                                                    <a  href="{{Route('show.videoForPhoto',$file->id)}}" class="dropdown-item" > Video</a>
                                                </div>

                                            @elseif($file->getType() == 'audio')
                                                <a  href="{{Route('show.photoForAudio',$file->id)}}" class="btn btn-secondary  " role="button" >Attach photo</a>
                                            @else
                                                <a  href="{{Route('show.photoForVideo',$file->id)}}" class="btn btn-secondary  " role="button" >Attach photo</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                        @endif
                        <br>
                        @if(Auth::check())
                        <div class=" ">
                            <div class="container card my-5 text-center ">
                               <div class="row justify-content-center">
                                  <div class="col-md-9">
                                            @if($file->userScoreFile())
                                                    <form method="post" action="{{Route('delete.rating',$file->id)}} ">
                                                        @method('delete')
                                                        @csrf
                                                        <p class="display-4">
                                                        Your score: {{$file->userScoreFile()}}
                                                        <button class="btn btn-outline-danger ">Delete</button>
                                                        </p>
                                                    </form>

                                            @else
                                                <form action="{{Route('set.rating',$file->id)}}" method="post" class="form-inline">
                                                 @csrf

                                                    <p class="display-4">Add your score:
                                                    <select class="form-control " name="rating">
                                                        <option value="5">5</option>
                                                        <option value="4">4</option>
                                                        <option value="3">3</option>
                                                        <option value="2">2</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                    <button class="btn btn-success">Send</button> </p>
                                                </form>
                                                 @endif
                                 </div>
                               </div>
                            </div>
                        </div>
                        @endif
                        <div class="card my-5">
                            <a href="{{route('getAttachedFiles',$file->id)}}" class="btn btn-primary stretched-link">Go to attached files</a>
                        </div>
                    </div>




                <div class="col-md-3">
                    <div class="card mb-3 box-shadow">
                        @if(isset($file->user->avatar))
                            <img class="card-img-top" width="349" src="{{asset('avatars/' . $file->user->avatar)}}" alt="Card image cap">
                        @else
                            <img class="card-img-top" src="http://www.mrgood1.com/web/img/thumb.jpg" alt="Card image cap">
                        @endif
                        <div class="card-body">
                            <h4><a href="{{Route('author.show',$file->user_id)}}">{{$file->user->getFullNameUser()}}</a></h4>
                            <p>{{$file->user->email}}</p>

                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted text-left">
                                    On the site since:
                                    @isset($file->user->created_at)
                                        {{$file->user->created_at->format('d.m.Y')}}
                                    @endisset
                                </small>
                            </div>
                        </div>
                    </div>
            </div>




                <div class="col-9 blog-main">
                        <h1 align="center">Comments</h1>
                        @if($file->comments->isEmpty())
                        <div class="alert alert-primary" role="alert">
                            <p class="h5" align="center">No comments yet</p>
                        </div>
                        @endif

                    <div class="comments">
                        <ul class="list-group">

                            @foreach($file->comments as $comment)
                                    <div class="card mb-4 box-shadow ">
                                    <li class="list-group-item">
                                        <p>
                                            <a href="{{Route('author.show',$comment->user_id)}}"><strong>{{$comment->user->getFullNameUser()}}:  </strong> </a>

                                            {{$comment->text_comment}}
                                        </p>
                                        <small class="text-muted text-left">
                                            @isset($comment->created_at)
                                                {{$comment->created_at->format('d.m.Y')}}
                                            @endisset
                                        </small>


                                    @if(Auth::id() == $comment->user_id)
                                        <div align="right ">
                                        <form method="post" action="/author/file/{{$comment->id}}/comment">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                        </div>
                                    @endif

                                </li>

                                </div>

                            @endforeach

                                @if(\Illuminate\Support\Facades\Auth::check())
                                        <div class="card-block"></div>
                                        <form method="post" action="/author/file/{{$file->id}}/comment">
                                            @method('put')
                                            @csrf
                                            <div class="form-group">
                                            <textarea name="text_comment" placeholder="Your comment" class="form-control">
                                            </textarea>
                                            </div>

                                            <div class="form-group" align="right">
                                                <button type="submit" class="btn btn-primary">Add comment</button>
                                            </div>
                                        </form>

                                @endif

                        </ul>
                    </div>

                </div>
             </div>
        </div>
    </div>

@endsection