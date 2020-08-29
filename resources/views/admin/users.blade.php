@extends('layouts.app')
@section('content')

<div id="scoped-content">
    <style type="text/css" scoped>
        th.rotate {
            height:150px;
            white-space: nowrap;
            position:relative;
        }

        th.rotate > div {
            transform: rotate(-90deg);
            position:absolute;
            left:0;
            right:0;
            top: 105px;
            margin:auto;
        }
    </style>

    <div class="card">
        <div class="card-header bg-dark text-white">
            Spisak svih korisnika
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Ime i prezime</th>
                            <th scope="col">E-mail</th>
                            <th scope="col" class="rotate"><div><span>Admin</span></div></th>
                            <th scope="col" class="rotate"><div><span>Servisi</span></div></th>
                            <th scope="col" class="rotate"><div><span>Radni sati</span></div></th>
                            <th scope="col" class="rotate"><div><span>Radni nalozi</span></div></th>
                            <th scope="col" class="rotate"><div><span>Podmazivanje</span></div></th>
                            <th scope="col" class="rotate"><div><span>Dokumenti</span></div></th>
                            <th scope="col" class="rotate"><div><span>Privatne stvari</span></div></th>
                            <th scope="col" class="rotate"><div><span>Lični radni sati</span></div></th>
                            <th scope="col">Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                            <tr>
                            <th scope="row"><small>{{ $user -> id }}</small></th>
                            <td class="text-nowrap">
                                <a href="{{ route('admin.permissions', $user -> id)}}">
                                    <small>{{ $user -> name }}</small>
                                </a>
                            </td>
                            <td class="text-nowrap"><small>{{ $user -> email }}</small></td>

                            <td class="text-center" style="white-space: nowrap;">
                                @if($user -> admin)
                                    &#9746;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user -> services)
                                    &#9746;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user -> workhours)
                                    &#9746;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user -> workorders)
                                    &#9746;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user -> lubrications)
                                    &#9746;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user -> files)
                                    &#9746;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user -> private_items)
                                    &#9746;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user -> worktimes)
                                    &#9746;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-nowrap"><small>{{ date('d. m. y.', strtotime($user -> created_at -> add(Config::get('sitesettings.timezoneoffset')))) }} - {{ date('H:i:s', strtotime($user -> created_at -> add(Config::get('sitesettings.timezoneoffset')))) }}</small></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
