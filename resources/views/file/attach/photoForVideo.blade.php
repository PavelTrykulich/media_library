@extends('layouts.app')


@section('content')
    <form action="{{Route('attach.photoForVideo',$id)}}" method="post">
        @method('put')
        @csrf


        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    @foreach($files as $file)



                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">

                                @if ($file->getType() == 'audio')
                                    <img class="card-img-top" src="http://www.mrgood1.com/web/img/thumb.jpg" alt="Card image cap">
                                    <audio controls style="width: 600px;" class="col-12">
                                        <source src="{{$file->getPathToFile()}}">
                                    </audio>
                                @elseif ($file->getType() == 'photo')
                                    <img class="card-img-top" src="http://www.mrgood1.com/web/img/thumb.jpg" alt="Card image cap">
                                @else
                                    <video width="349"  controls>
                                        <source src="{{$file->getPathToFile()}}" type="video/mp4">
                                    </video>
                                @endif

                                <div class="card-body">
                                    <h4><a  href="{{Route('files.show',$file->id)}}">{{$file->title}}</a></h4>

                                    <small class="text-muted">
                                        @if($file->getGenres())
                                            <p>
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

                                    <div class="custom-control custom-checkbox align-items-md-center">

                                        <input  type="checkbox" class="custom-control-input" id="{{$file->title }}" name='filesId[]' value="{{$file->photo->id}}"
                                                {{in_array($file->photo->id,$checked) ? 'checked' : ''}}>
                                        <label class="custom-control-label " for="{{$file->title }}" >Add</label>

                                    </div>

                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
        </div>

        <div class="align-items-center justify-content-md-center text-md-center">
            <button class="btn btn-success">Submit</button>
        </div>
    </form>
@endsection