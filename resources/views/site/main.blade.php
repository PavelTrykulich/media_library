@extends('layouts')

@section('content')
    <!-- Контент страницы -->
    <div class="container text-center">
        <h1 class="h3 mt-5 mb-1">Bootstrap 4 - Carousel (карусель)</h1>
        <h2 class="lead mt-0 mb-5">с индикаторами</h2>


        <div id="carousel" class="carousel slide d-inline-block" data-ride="carousel">
            <!-- Индикаторы -->
            <ol class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fluid" src="https://img.lun.ua/building-800x600/25105.jpg" alt="...">
                    <div class="carousel-caption">
                        <h5>Title of the first slide</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid" src="https://img.lun.ua/building-800x600/25105.jpg" alt="...">
                    <div class="carousel-caption">
                        <h5>Title of the second slide</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid" src="https://img.lun.ua/building-800x600/25105.jpg" alt="...">
                    <div class="carousel-caption">
                        <h5>Title of the third slide</h5>
                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                    </div>
                </div>
            </div>
            <!-- Элементы управления -->
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Предыдущий</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Следующий</span>
            </a>
        </div>

    </div>
    <main role="main">

        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">Hello, world!</h1>
                <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
            </div>
        </div>

        <div class="container">

            <div class="row">

                @foreach($files as $file)
                    <div class="col-md-4">
                        <h2>{{$file->title}}</h2>

                        <p>{{$file->short_description}}</p>
                        {{--<p>{{$file->photo->genrePhotos}}</p>--}}
                        @foreach($file->photo->genrePhotos as $title)
                            <p>{{$title->title}}</p>
                        @endforeach

                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                @endforeach

            </div>


        </div>

    </main>
@endsection