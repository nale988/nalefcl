<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- ---------------------------------- -->
<!-- Naser Kešetović                    -->
<!-- naser.kesetovic@outlook.com        -->
<!-- Based on Laravel.com (7.x)         -->
<!-- MIT licence                        -->
<!-- ---------------------------------- -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FCL') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        #btnTop {
            position: fixed;
            bottom:20px;
            right:20px;
            display: none;
            z-index: 999;
            text-align: center;
        }

        $btnTop:hoover{
            background:rgba(0,0,0,.6);
        }
    </style>
</head>
<body>
<button onClick="topFunction()" id="btnTop" class="btn btn-danger">
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shift-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M7.27 2.047a1 1 0 0 1 1.46 0l6.345 6.77c.6.638.146 1.683-.73 1.683H11.5v3a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-3H1.654C.78 10.5.326 9.455.924 8.816L7.27 2.047z"/>
    </svg>
</button>

<div id="app">
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
          <div class="container">
            <div class="row">
                <!-- todos list -->
                @auth
                @if($userrole -> todos)
                    @if(count($urgenttodos)>0 || count($othertodos)>0)
                    <div class="col-sm-8 py-4 gx-2">
                        @auth
                            @include('layouts.todos');
                        @endauth
                    </div>
                    @endif
                @endif
                @endauth
                <div class="col-sm-4 py-4">
                    @auth
                        @include('layouts.options');
                    @endauth
                </div>
            </div>
          </div>
        </div>

        <div class="navbar navbar-dark bg-dark box-shadow">
          <div class="container">
            <ul class="nav">
                <li>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="text-decoration: none; color: #ffffff" href="#" data-toggle="collapse" data-target="#navbarHeader">
                        <strong>&nbsp;&nbsp;&nbsp;FCLukavac&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('home')}}">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
                        <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                    </svg>
                    </a>
                </li>
                <!-- spare part order -->
                @auth
                @if($userrole -> spare_parts_order)
                    @if($orders > 0)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sparepartorders.index') }}" title="Narudžbe">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart3" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            </svg>
                            <span class="badge badge-pill badge-danger">{{ $orders }}</span>
                        </a>
                    </li>
                    @endif
                @endif

                <!-- todos -->
                @if($userrole -> todos)
                    @if($todoscount > 0)
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#navbarHeader" title="Poslovi kojima je isteklo vrijeme">
                            @include('layouts.buttons.btnlightning', ['color' => 'white'])
                            <span class="badge badge-pill badge-danger">{{ $todoscount }}</span>
                        </a>
                    </li>
                    @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('todos.create') }}" title="Novi zadatak">
                        @include('layouts.buttons.btnnewtodo', ['color' => 'white'])
                    </a>
                </li>
                @endif
                @endauth
            </ul>

            <form class="form-inline mt-2 mt-md-0" action="{{ route('search') }}" method="GET">
                @csrf
                <input class="form-control mr-sm-2" type="text" name="searchvalue" placeholder="..." aria-label="Search">
                <div class="btn-group">
                    <button class="btn btn-danger" type="submit" name="searchwhere" value="position">Pozicije</button>
                    <button class="btn btn-danger" type="submit" name="searchwhere" value="navision">Nav</button>
                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Mogućnosti</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <h6 class="dropdown-header">Pretraga</h6>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" type="submit" name="searchwhere" value="spareparts">u rezervnim dijelovima</button>
                        <button class="dropdown-item" type="submit" name="searchwhere" value="spareparttypes">u vrsti rezervnih dijelova</button>
                        <button class="dropdown-item" type="submit" name="searchwhere" value="documents">u imenima dokumenata</button>
                        <button class="dropdown-item" type="submit" name="searchwhere" value="revisions">u napomenama</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </header>
</div>

<!-- Tooltips -->
<main class="py-4">
    @if ($errors->any())
    <div class="container">
        <div class="alert alert-danger alert-dismissible text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Zatvori">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    @if (Session::has('message'))
    <div class="container">
        <div class="alert alert-info alert-dismissible text-center" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Zatvori">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    @if (Session::has('warning'))
    <div class="container">
        <div class="alert alert-warning alert-dismissible text-center" role="alert">
            {{ Session::get('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Zatvori">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    @if (Session::has('alert'))
    <div class="container">
        <div class="alert alert-danger alert-dismissible text-center" role="alert">
            {{ Session::get('alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Zatvori">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    <div class="container">
        @yield('content')
    </div>
    <br />
    <br />
</main>
<script>
    var scrollbutton = document.getElementById("btnTop");
    window.onscroll = function() { scrollFunction()};

    function scrollFunction(){
        if(document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20){
                scrollbutton.style.display = "block";
            } else {
                scrollbutton.style.display = "none";
            }
    }

    function topFunction(){
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
</body>
</html>
