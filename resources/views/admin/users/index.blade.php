@extends('admin.layouts.layout')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach($users as $user)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">

                            @if(isset($user->avatar))
                                <img class="card-img-top" width="349" src="{{asset('avatars/' . $user->avatar)}}" alt="Card image cap">
                            @else
                                <img class="card-img-top" src="http://www.mrgood1.com/web/img/thumb.jpg" alt="Card image cap">
                            @endif
                            <div class="card-body">
                                <h4>{{$user->getFullNameUser()}}</h4>
                                <h4>{{$user->email}}</h4>



                                <div class="d-flex justify-content-between align-items-center">


                                    <div class="btn-group">
                                        <a href="{{Route('users.show',$user->id)}}" class="btn btn-info">Show</a>
                                    </div>
                                    <small class="text-muted">
                                        @isset($user->created_at)
                                            {{$user->created_at->format('d.m.Y')}}
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
            {{$users->links()}}
        </div>
    </div>



@endsection





