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
    &#8673;
</button>

<div id="app">
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
          <div class="container">
            <div class="row">
                <!-- todos list -->
                @auth
                @if($userrole -> todos)
                    @if($usersettings -> use_todos)
                        @if(count($urgenttodos)>0 || count($othertodos)>0)
                        <div class="col-sm-8 py-4 gx-2">
                            @auth
                                @include('layouts.todos')
                            @endauth
                        </div>
                        @endif
                    @endif
                @endif
                @endauth
                <div class="col-sm-4 py-4">
                    @auth
                        @include('layouts.options')
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
                    <a class="navbar-brand" href="{{ route('home')}}">
                        <strong>&nbsp;&nbsp;&nbsp;FCLukavac&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                    </a>
                </li>
                <!-- spare part order -->
                @auth
                @if($userrole -> spare_parts_order)
                    @if($dueorders > 0)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sparepartorders.index') }}" title="Istekle narudžbe">
                            @include('layouts.buttons.btnorders', ['color' => 'white'])
                            <span class="badge badge-pill badge-danger">{{ $dueorders }}</span>
                        </a>
                    </li>
                    @endif
                @endif

                <!-- todos -->
                @if($userrole -> todos)
                    @if($usersettings -> use_todos)
                        @if($todoscount > 0)
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" data-toggle="collapse" data-target="#navbarHeader" title="Poslovi kojima je isteklo vrijeme">
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
