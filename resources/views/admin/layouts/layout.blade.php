<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Admin panel</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

@include('admin.layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light bg">
            <div class="sidebar-sticky nav flex-column border-dark bor my-4">

                    <ul>
                        <li>
                            <a class=" alert-link " href="{{Route('users.index')}}">
                                Authors
                            </a>
                        </li>
                        <li>
                            <a class=" alert-link" href="{{Route('comments.index')}}">
                                Comments
                            </a>
                        </li>
                        <li>
                            <a class=" alert-link" href="{{Route('all_files.index')}}">
                                All Files
                            </a>
                        </li>
                    </ul>





                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Photo</span>

                </h6>
                <ul>

                    <li class="nav-item">
                        <a class="alert-link" href="{{Route('genre_photos.index')}}">
                            Genres
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="alert-link" href="{{Route('format_photos.index')}}">
                            Formats
                        </a>

                    </li>
                </ul>



                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Video</span>

                </h6>
                <ul>
                    <li class="nav-item">
                        <a class="alert-link" href="{{Route('genre_videos.index')}}">
                            Genres
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="alert-link" href="{{Route('format_videos.index')}}">
                            Formats
                        </a>

                    </li>
                </ul>


                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Audio</span>

                </h6>
                <ul>
                    <li class="nav-item">
                        <a class="alert-link" href="{{Route('genre_audios.index')}}">
                            Genres
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="alert-link" href="{{Route('format_audios.index')}}">
                            Formats
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

            @yield('content')

        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
</body>
</html>