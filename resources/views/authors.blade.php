@extends('layouts.app')


@section('content')


    {{--

        <main role="main">
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Top files</h1>
                    <p class="lead text-muted">The best files for user evaluation.</p>


                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="http://www.mrgood1.com/web/img/thumb.jpg"  height="600px" alt="Первый слайд">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="http://www.mrgood1.com/web/img/thumb.jpg" height="600px" alt="Второй слайд">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="http://www.mrgood1.com/web/img/thumb.jpg" height="600px" alt="Третий слайд">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>


                </div>
            </section>
    --}}

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
                                        <a type="button" class="btn btn-sm btn-primary" href="{{Route('author.show',$user->id)}}">View</a>
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
    </main>

@endsection
