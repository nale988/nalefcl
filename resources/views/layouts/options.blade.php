<h4 class="text-white"><u>Opcije</u></h4>
<ul class="list-unstyled">
    <!-- spare_parts_add -->
    @auth
    @if($userrole -> spare_parts_add)
    <li>
        <a class="text-white" href="{{ url('/spareparts/create') }}" title="Dodaj novi rezervni dio">
            @include('layouts.buttons.btnsparepart', ['color' => 'white'])
            <small><span class="text-white">Novi rezervni dio</span></small>
        </a>
    </li>
    @endif
    <!-- spare parts orders -->
    @if($userrole -> spare_parts_order && $orders > 0)
    <li>
        <a class="text-white" href="{{ route('sparepartorders.index') }}" title="Narudžbe">
            @include('layouts.buttons.btnorders', ['color' => 'white'])
            <small><span class="text-white">Narudžbe</span></small>
        </a>
    </li>
    @endif
    @endauth
    <!-- units -->
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

    <!-- favorites -->
    @auth
    @if($userrole -> favorites && $usersettings -> use_favorites && count($favorites) > 0)
        <li>
            <a class="text-white dropdown-toggle" data-toggle="collapse" href="#cFavoritePositions" role="button" aria-expanded="false" aria-controls="cFavoritePositions">
                @include('layouts.buttons.btnfavoriteempty', ['color' => 'white'])
                <small><span class="text-white">Odabrane pozicije</span></small>
            </a>
            <div class="collapse" id="cFavoritePositions">
                @foreach($favorites as $favorite)
                <ul class="list-unstyled">
                    <li>
                        @include('layouts.buttons.btnrightarrow', ['color' => 'gray'])
                        <small><a href="{{ route('positions.show', $favorite->position_id) }}" class="text-white text-truncate" style="text-decoration:none;">{{ $favorite -> position }} - {{ $favorite -> name }}</a></small>
                    </li>
                </ul>
                @endforeach
            </div>
        </li>
    @endif
    @endauth

    <!-- guest -->
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
                @include('layouts.buttons.btnuser',['color' => 'white'])
                <small><span class="text-white">{{ Auth::user() -> name }}</span></small>
            </a>
            <div class="collapse" id="cUser">
                <ul class="list-unstyled">
                    @if($userrole -> worktimes)
                        <li>
                            <a class="text-white" href="{{ route('worktimes.index') }}">
                                @include('layouts.buttons.btnrightarrow', ['color' => 'gray'])
                                <small><span class="text-white">Pregled radnih sati</span></small>
                            </a>
                        </li>
                        <li>
                            <a class="text-white" href="{{ route('worktimes.create') }}">
                                @include('layouts.buttons.btnrightarrow', ['color' => 'gray'])
                                <small><span class="text-white">Unos radnih sati</span></small>
                            </a>
                        </li>
                    @endif
                    <li>
                        @include('layouts.buttons.btnrightarrow', ['color' => 'gray'])
                        <a href="{{ route('personal.workorders')}}" class="text-white">
                            <small>Moji radni nalozi</small>
                        </a>
                    </li>
                    @if($userrole -> admin)
                        <li>
                            <a class="text-white" href="{{ route('admin.index') }}" title="Opšti pregled">
                                @include('layouts.buttons.btnrightarrow', ['color' => 'gray'])
                                <small><span class="text-white">Admin: Opšti pregled</span></small>
                            </a>
                        </li>
                        <li>
                            <a class="text-white" href="{{ route('admin.users') }}" title="Korisnici">
                                @include('layouts.buttons.btnrightarrow', ['color' => 'gray'])
                                <small><span class="text-white">Admin: Korisnici</span></small>
                            </a>
                        </li>
                    @endif
                    <li>
                        @include('layouts.buttons.btnrightarrow', ['color' => 'gray'])
                        <a href="{{ route('logout') }}" class="text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <small>Log-out</small>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </li>
        @endguest
    <li>
        <small class="text-muted">Navision: {{ Config::get('sitesettings.navision_date')}}</small><br/>
        <small class="text-muted">Radni nalozi: {{ Config::get('sitesettings.workorders_date')}}</small><br />
        <small class="text-muted"><i>Reply: {{ round(microtime(true) - LARAVEL_START, 2) }}s</i></small>
    </li>
</ul>
