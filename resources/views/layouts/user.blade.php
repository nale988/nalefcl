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
