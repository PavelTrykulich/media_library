<nav class="navbar  navbar-expand-md navbar-dark navbar-laravel bg-dark ">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Media library
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="btn nav-link active" href="{{route('all.files')}}">All files</a>
                </li>
                <li class="nav-item active">
                    <a class="btn nav-link active" href="{{Route('authors')}}">Authors</a>
                </li>

                <li class="nav-item active">
                    <div class="dropdown show">
                        <a class="btn  dropdown-toggle nav-link active" href="#"  id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" >
                            File types
                        </a>
                        <div class="dropdown-menu " aria-labelledby="dropdownMenuLink" aria-haspopup="true" >
                            <a class="dropdown-item" href="{{Route('files.type','audio')}}">Audio</a>
                            <a class="dropdown-item" href="{{Route('files.type','photo')}}">Photo</a>
                            <a class="dropdown-item" href="{{Route('files.type','video')}}">Video</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="btn nav-link active" href="{{Route('files.genres')}}">Genres</a>
                </li>
                <li class="nav-item">
                    <a class="btn nav-link active" href="{{Route('files.formats')}}">Formats</a>
                </li>
                <li class="nav-item">
                </li>
            </ul>

            <ul class="navbar-nav ">
                    <form class="form-inline" action="{{Route('files.searchName')}}" method="get">
                        <input class="form-control mr-sm-2" type="search" name='name' placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle active" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            @if(Auth::user()->is_admin == true)
                                <a class="dropdown-item" href="{{ route('admin.panel') }}">
                                    Admin
                                </a>
                            @endif

                            <a class="dropdown-item" href="{{ route('author.show',Auth::id()) }}">
                                {{'Profile'}}
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
