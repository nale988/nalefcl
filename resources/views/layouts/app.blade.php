<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FCL') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<?php
if(Auth::check()){
    $urgents = App\ToDo::where('done', 0)->where('user_id', Illuminate\Support\Facades\Auth::user() -> id)->get()->sortByDesc('urgent')->groupBy('urgent');
    $favorites = Favorite::leftJoin('positions', 'favorites.position_id', '=', 'positions.id')->where('user_id', Illuminate\Support\Facades\Auth::user() -> id)->get()->sortBy('position');
    $orders = App\SparePartOrder::where('user_id', Auth::user() -> id)->where('done', 0)->get();
}
else{
    $orders = collect();
    $favorites = collect();
    $urgents = collect();
}
    $todoscount = 0;
?>
<div id="app">
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
          <div class="container">
            <div class="row">
              <div class="col-sm-3 py-4">
                @if(Illuminate\Support\Facades\Auth::check())
                    <h4 class="text-white"><u>Odabrane pozicije</u></h4>
                    <ul class="list-unstyled">
                        @foreach($favorites as $favorite)
                            <li><small><a href="{{ route('positions.show', $favorite->position_id) }}" class="text-white text-truncate" style="text-decoration:none;">&nbsp;&nbsp;&nbsp;{{ $favorite -> position }} - {{ $favorite -> name }}</a></small></li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-sm-5 py-4 gx-2">
            @if(Illuminate\Support\Facades\Auth::check())
                <h4 class="text-white"><u>Poslovi</u></h4>
                <ul class="list-unstyled">
                    @foreach($urgents as $urgent => $todos)
                        @foreach($todos->sortBy('date') as $todo)
                            @if($loop -> first && $urgent == 1)
                                <li>&nbsp;&nbsp;<strong><span class="text-white">Bitno:</span></strong></li>
                            @endif

                            @if($loop -> first && $urgent == 0)
                                <li>&nbsp;&nbsp;<strong><span class="text-white">Ostalo:</span></strong></li>
                            @endif
                            <li>
                                @if($todo -> urgent == 1)
                                    <div class="row text-white text-truncate">
                                @else
                                    <div class="row text-muted text-truncate">
                                @endif

                                @if($todo -> urgent == 1 && now() -> gt($todo -> date))
                                    <?php
                                        ++$todoscount
                                    ?>
                                @endif
                                    <div class="col">
                                        <a href="{{ route('todos.finish', $todo -> id) }}" class="text-white">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                                <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 13.5 8a.5.5 0 0 1 1 0 6.5 6.5 0 1 1-3.25-5.63.5.5 0 1 1-.5.865A5.472 5.472 0 0 0 8 2.5z"/>
                                            </svg>
                                        </a>

                                        <small>{{ date('d. m. Y', strtotime($todo -> date)) }}: {{ $todo -> description }}</small>
                                        @if(now() -> gt($todo -> date))
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-alarm" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A6 6 0 1 0 8 3a6 6 0 0 0 0 12zm0 1A7 7 0 1 0 8 2a7 7 0 0 0 0 14z"/>
                                                <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.053.224l-1.5 3a.5.5 0 1 1-.894-.448L7.5 8.882V5a.5.5 0 0 1 .5-.5z"/>
                                                <path d="M.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
                                                <path fill-rule="evenodd" d="M11.646 14.146a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1-.708.708l-1-1a.5.5 0 0 1 0-.708zm-7.292 0a.5.5 0 0 0-.708 0l-1 1a.5.5 0 0 0 .708.708l1-1a.5.5 0 0 0 0-.708zM5.5.5A.5.5 0 0 1 6 0h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                                <path d="M7 1h2v2H7V1z"/>
                                            </svg>

                                        @else
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-alarm" fill="#343A40" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A6 6 0 1 0 8 3a6 6 0 0 0 0 12zm0 1A7 7 0 1 0 8 2a7 7 0 0 0 0 14z"/>
                                                <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.053.224l-1.5 3a.5.5 0 1 1-.894-.448L7.5 8.882V5a.5.5 0 0 1 .5-.5z"/>
                                                <path d="M.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
                                                <path fill-rule="evenodd" d="M11.646 14.146a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1-.708.708l-1-1a.5.5 0 0 1 0-.708zm-7.292 0a.5.5 0 0 0-.708 0l-1 1a.5.5 0 0 0 .708.708l1-1a.5.5 0 0 0 0-.708zM5.5.5A.5.5 0 0 1 6 0h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                                <path d="M7 1h2v2H7V1z"/>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @if($loop -> last)
                                <li>&nbsp;</li>
                            @endif
                        @endforeach
                    @endforeach
                    <li>
                        <div class="row">
                            <div class="col-auto">
                                <small><a href="{{ route('todos.create') }}" class="btn btn-sm btn-outline-danger">Dodaj novo</a></small>
                            </div>
                        </div>
                    </li>
                </ul>
            @endif
            </div>

            <div class="col-sm-4 py-4">
                <h4 class="text-white"><u>Opcije</u></h4>
                <ul class="list-unstyled">
                    <li>
                        <a class="text-white" href="{{ url('/spareparts/create') }}" title="Dodaj novi rezervni dio">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                                <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                            </svg>
                            <small><span class="text-white">Novi rezervni dio</span></small>
                        </a>
                    </li>
                    <li>
                        <a class="text-white" href="{{ url('advancedsearch') }}" title="Dodaj novi rezervni dio">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                            </svg>
                            <small><span class="text-white">Napredna pretraga</span></small>
                        </a>
                    </li>
                    @if(Illuminate\Support\Facades\Auth::check())
                        @if(App\UserRole::where('user_id', Auth::user() -> id)->first()->worktimes==1)
                            <li>
                                <a class="text-white" href="{{ route('worktimes.index') }}">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock-history" fill="white" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                                        <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                                        <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    <small><span class="text-white">Pregled radnih sati</span></small>
                                </a>
                            </li>
                            <li>
                                <a class="text-white" href="{{ route('worktimes.create') }}">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock" fill="white" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                                        <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    <small><span class="text-white">Unos radnih sati</span></small>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
                <h4 class="text-white"><u>Korisnik</u></h4>
                <ul class="list-unstyled">
                <li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
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
                    <li class="nav-item">
                        <span class="text-white float-right"><small>&nbsp;&nbsp;&nbsp;Nav: {{ Config::get('sitesettings.navision_date')}}</small></span>
                        <span class="text-white float-right"><small>&nbsp;RN: {{ Config::get('sitesettings.workorders_date')}}</small></span><br/>
                        <span class="text-muted float-right"><small><i>Response: {{ round(microtime(true) - LARAVEL_START, 2) }}s</i></small></span>
                    </li>
                </li>
                </ul>
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

                @if(count($orders) > 0)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sparepartorders.index') }}" title="Narudžbe">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart3" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg>
                        <span class="badge badge-pill badge-danger">{{ count($orders) }}</span>
                    </a>
                </li>
                @endif
                @if($todoscount > 0)
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#navbarHeader" title="Poslovi kojima je isteklo vrijeme">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lightning" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09zM4.157 8.5H7a.5.5 0 0 1 .478.647L6.11 13.59l5.732-6.09H9a.5.5 0 0 1-.478-.647L9.89 2.41 4.157 8.5z"/>
                        </svg>
                        <span class="badge badge-pill badge-danger">{{ $todoscount }}</span>
                    </a>
                </li>
                @endif
                <!--
                <li class="nav-item text-white">
                    <a class="nav-link" href="{{ route('dangerlevelspareparts') }}" title="Signalne zalihe">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-octagon" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg>
                    </a>
                </li>
                -->
            </ul>

            <form class="form-inline mt-2 mt-md-0" action="{{ route('search') }}" method="GET">
                @csrf
                <input class="form-control mr-sm-2" type="text" name="searchvalue" placeholder="..." aria-label="Search">
                <div class="btn-group">
                    <button class="btn btn-danger" type="submit" name="searchwhere" value="position">Traži</button>
                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <h6 class="dropdown-header">Pretraga</h6>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" type="submit" name="searchwhere" value="spareparts">u rezervnim dijelovima</button>
                        <button class="dropdown-item" type="submit" name="searchwhere" value="spareparttypes">u vrsti rezervnih dijelova</button>
                        <button class="dropdown-item" type="submit" name="searchwhere" value="documents">u imenima dokumenata</button>
                        <button class="dropdown-item" type="submit" name="searchwhere" value="revisions">u napomenama</button>
                        <button class="dropdown-item" type="submit" name="searchwhere" value="navision">u Navisionu</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </header>
</div>

<main class="py-4">
    @if ($errors->any())
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
    @endif

    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible text-center" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Zatvori">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (Session::has('alert'))
        <div class="alert alert-danger alert-dismissible text-center" role="alert">
            {{ Session::get('alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Zatvori">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container">
        @yield('content')
    </div>
</main>
</body>
</html>
