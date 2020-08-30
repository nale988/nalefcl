<h4 class="text-white"><u>Opcije</u></h4>
<ul class="list-unstyled">
    @if($userrole -> spare_parts_add)
    <li>
        <a class="text-white" href="{{ url('/spareparts/create') }}" title="Dodaj novi rezervni dio">
            @include('layouts.buttons.btnsparepart', ['color' => 'white'])
            <small><span class="text-white">Novi rezervni dio</span></small>
        </a>
    </li>
    @endif
    <li>
        <a class="text-white dropdown-toggle" data-toggle="collapse" href="#cUnits" role="button" aria-expanded="false" aria-controls="cUnits">
            @include('layouts.buttons.btnunits', ['color' => 'white'])
            <small><span class="text-white">Troškovne jedinice</span></small>
        </a>
        <div class="collapse" id="cUnits">
            <ul class="list-unstyled">
                @foreach($units as $unit)
                <li>
                    <a class="text-white" href="{{ route('showunits', $unit -> id)}}">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="gray" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.793 8 8.146 5.354a.5.5 0 0 1 0-.708z"/>
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 0 1H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                        <small>{{ $unit -> unit_number }}: {{ $unit -> description }}</small>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </li>
    @if($userrole -> favorites)
    @if(count($favorites) > 0)
        <li>
            <a class="text-white dropdown-toggle" data-toggle="collapse" href="#cFavoritePositions" role="button" aria-expanded="false" aria-controls="cFavoritePositions">
                @include('layouts.buttons.btnfavoriteempty', ['color' => 'white'])
                <small><span class="text-white">Odabrane pozicije</span></small>
            </a>
            <div class="collapse" id="cFavoritePositions">
                @foreach($favorites as $favorite)
                <ul class="list-unstyled">
                    <li>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="gray" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.793 8 8.146 5.354a.5.5 0 0 1 0-.708z"/>
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 0 1H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                        <small><a href="{{ route('positions.show', $favorite->position_id) }}" class="text-white text-truncate" style="text-decoration:none;">{{ $favorite -> position }} - {{ $favorite -> name }}</a></small>
                    </li>
                </ul>
                @endforeach
            </div>
        </li>
    @endif
    @endif
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
    <li>
        <a class="text-white dropdown-toggle" data-toggle="collapse" href="#cUser" role="button" aria-expanded="false" aria-controls="cUser">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            </svg>
            <small><span class="text-white">{{ Auth::user() -> name }}</span></small>
        </a>
        <div class="collapse" id="cUser">
            <ul class="list-unstyled">
                @if(App\UserRole::where('user_id', Auth::user() -> id)->first()->worktimes==1)
                    <li>
                        <a class="text-white" href="{{ route('worktimes.index') }}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="gray" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.793 8 8.146 5.354a.5.5 0 0 1 0-.708z"/>
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 0 1H4.5A.5.5 0 0 1 4 8z"/>
                            </svg>
                            <small><span class="text-white">Pregled radnih sati</span></small>
                        </a>
                    </li>
                    <li>
                        <a class="text-white" href="{{ route('worktimes.create') }}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="gray" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.793 8 8.146 5.354a.5.5 0 0 1 0-.708z"/>
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 0 1H4.5A.5.5 0 0 1 4 8z"/>
                            </svg>
                            <small><span class="text-white">Unos radnih sati</span></small>
                        </a>
                    </li>
                @endif
                @if(App\UserRole::where('user_id', Auth::user() -> id)->first()->admin==1)
                    <li>
                        <a class="text-white" href="{{ route('admin.index') }}" title="Admin">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="gray" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.793 8 8.146 5.354a.5.5 0 0 1 0-.708z"/>
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 0 1H4.5A.5.5 0 0 1 4 8z"/>
                            </svg>
                            <small><span class="text-white">Admin panel</span></small>
                        </a>
                    </li>
                    <li>
                        <a class="text-white" href="{{ route('admin.users') }}" title="Korisnici">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="gray" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.793 8 8.146 5.354a.5.5 0 0 1 0-.708z"/>
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 0 1H4.5A.5.5 0 0 1 4 8z"/>
                            </svg>
                            <small><span class="text-white">Korisnici (admin)</span></small>
                        </a>
                    </li>
                @endif
                    <li>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="gray" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.793 8 8.146 5.354a.5.5 0 0 1 0-.708z"/>
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 0 1H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                        <a href="{{ route('personal.myworkorders')}}" class="text-white">
                            <small>Moji nalozi</small>
                        </a>
                    </li>
                    <li>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-short" fill="gray" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.793 8 8.146 5.354a.5.5 0 0 1 0-.708z"/>
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 0 1H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                        <a href="{{ route('logout') }}" class="text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <small>Log-out</small>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

            </ul>
        </div>
        @endguest
    </li>
    <li>
        <small class="text-muted">Navision: {{ Config::get('sitesettings.navision_date')}}</small><br/>
        <small class="text-muted">Radni nalozi: {{ Config::get('sitesettings.workorders_date')}}</small><br />
        <small class="text-muted"><i>Reply: {{ round(microtime(true) - LARAVEL_START, 2) }}s</i></small>
    </li>
</ul>
