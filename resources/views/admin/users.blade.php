@extends('layouts.app')
@section('content')

<div id="scoped-content">
    <style type="text/css" scoped>
        th.rotate {
            height:160px;
            white-space: nowrap;
            position:relative;
        }

        th.rotate > div {
            transform: rotate(-90deg);
            position:absolute;
            left:0;
            right:0;
            top: 125px;
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
                            <th scope="col" class="rotate"><div><span>ToDos</span></div></th>
                            <th scope="col" class="rotate"><div><span>Rezervni dijelovi</span></div></th>
                            <th scope="col" class="rotate"><div><span>Rezervni dijelovi (+)</span></div></th>
                            <th scope="col" class="rotate"><div><span>Rezervni dijelovi (ord)</span></div></th>
                            <th scope="col" class="rotate"><div><span>Napomene</span></div></th>
                            <th scope="col" class="rotate"><div><span>Napomene (+)</span></div></th>
                            <th scope="col" class="rotate"><div><span>Servisi</span></div></th>
                            <th scope="col" class="rotate"><div><span>Servisi (+)</span></div></th>
                            <th scope="col" class="rotate"><div><span>Radni sati<span></div></th>
                            <th scope="col" class="rotate"><div><span>Radni sati (+)<span></div></th>
                            <th scope="col" class="rotate"><div><span>Radni nalozi</span></div></th>
                            <th scope="col" class="rotate"><div><span>Radni nalozi (+)</span></div></th>
                            <th scope="col" class="rotate"><div><span>Podmazivanje</span></div></th>
                            <th scope="col" class="rotate"><div><span>Podmazivanje (+)</span></div></th>
                            <th scope="col" class="rotate"><div><span>Dokumenti</span></div></th>
                            <th scope="col" class="rotate"><div><span>Dokumenti (+)</span></div></th>
                            <th scope="col" class="rotate"><div><span>Privatne stvari</span></div></th>
                            <th scope="col" class="rotate"><div><span>Lični radni sati</span></div></th>
                            <th scope="col" class="rotate"><div><span>Omiljene pozicije</span></div></th>
                            <th scope="col">Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user_data)
                            <tr>
                            <th scope="row"><small>{{ $user_data -> id }}</small></th>
                            <td class="text-nowrap">
                                <a href="{{ route('admin.permissions', $user_data -> id)}}">
                                    <small>{{ $user_data -> name }}</small>
                                </a>
                            </td>
                            <td class="text-nowrap"><small>{{ $user_data -> email }}</small></td>

                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> admin)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> todos)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> spare_parts_view)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> spare_parts_add)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> spare_parts_order)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> revisions_view)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> revisions_add)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> services_view)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> services_add)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>

                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> workhours_view)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> workhours_add)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>

                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> workorders_view)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> workorders_add)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>

                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> lubrications_view)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> lubrications_add)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>

                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> files_view)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> files_add)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>

                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> private_items)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> worktimes)
                                    &#9746;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-center" style="white-space: nowrap;">
                                @if($user_data -> favorites)
                                    &#8718;
                                @else
                                    &#9744;
                                @endif
                            </td>
                            <td class="text-nowrap"><small>{{ date('d. m. y.', strtotime($user_data -> created_at -> add(Config::get('sitesettings.timezoneoffset')))) }} - {{ date('H:i:s', strtotime($user_data -> created_at -> add(Config::get('sitesettings.timezoneoffset')))) }}</small></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
