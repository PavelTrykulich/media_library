@extends('admin.layouts.layout')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row ">
                    <div class="col-md-9 ">
                        <div class="card mb-4 box-shadow ">
                            @if ($file->getType() == 'audio')
                                <img class="card-img-top" src="http://www.mrgood1.com/web/img/thumb.jpg" alt="Card image cap">
                                <audio controls style="width: 600px;" class="col-12">
                                    <source src="{{$file->getPathToFile()}}">
                                </audio>
                            @elseif ($file->getType() == 'photo')
                                <img class="card-img-top" src="http://www.mrgood1.com/web/img/thumb.jpg" alt="Card image cap">
                            @else
                                <video width="824"  controls>
                                    <source src="{{$file->getPathToFile()}}" type="video/mp4">
                                </video>
                            @endif
                            <div class="card-body">
                                <h2><a href="{{Route('files.show',$file->id)}}">{{$file->title}}</a></h2>
                                <p class="card-text">{{$file->short_description}}</p>
                                <p class="card-text">{{$file->description}}</p>


                                <small class="text-muted">
                                    {{ $file->date_last_eval ? 'Date last eval:' . ' ' . $file->date_last_eval : '' }}
                                </small>
                                <br>

                                <small class="text-muted">
                                    {{ $file->size ? 'Size:' . ' ' . $file->getSize() : '' }}
                                </small>
                                <br>
                                <small class="text-muted"> Format:

                                    <a  href="{{Route('files.format',['type' => $file->getType(),'format' => trim($file->getFormat())])}}">{{$file->getFormat()}}</a>

                                @if($file->getGenres()->count() > 0 )
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
                                    <small class="text-muted">
                                        @isset($file->created_at)
                                            {{$file->created_at->format('d.m.Y')}}
                                        @endisset
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <a  href="{{Route('all_files.edit',$file->id)}}" type="submit" class="btn btn-info"  >Update file</a>
                                </div>
                                <div class="col-md-2">
                                    <form method="post" action="{{Route('all_files.destroy',$file->id)}}   ">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete file</button>
                                    </form>
                                </div>

                            </div>
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
                            <p class="card-text">{{$file->user->description}}</p>
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
            </div>
        </div>
    </div>
@endsection