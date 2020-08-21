<div class="card">
    <div class="card-header bg-dark text-white">
        <div data-spy="scroll" data-target="#back-to-top" data-offset="0">
            <nav id="navbar-spareparts" class="navbar navbar-light bg-light">
                <a class="navbar-brand" href="#">Navbar</a>
                <ul class="nav nav-pills">
                    @foreach($spareparts->sortBy('storage_number') as $title => $parts)
                        <li class="nav-item">
                        @if(strlen($title) < 1 || !isset($title) || empty($title) || trim($title) === '')
                            <a class="nav-link" href="#sp_nogroup">Bez grupe</a>
                        @else
                            <a class="nav-link" href="#sp_{{ preg_replace('/[^a-z0-9.]+/i', '-', $title) }}">{{ $title }}</a>
                        @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>

    <div class="card-body">
        <div data-spy="scroll" data-target="#navbar-spareparts" data-offset="50">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">Skl. broj</th>
                        <th scope="col" class="text-nowrap">Opis</th>
                        <th scope="col" class="text-nowrap">Kat. broj</th>
                        <th scope="col" class="text-nowrap">Opcije</th>
                        <th scope="col" class="text-right">Količina</th>
                        <th scope="col" class="text-right">Magacin</th>
                        <th scope="col" class="text-right">Cijena</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($spareparts->sortBy('storage_number') as $title => $parts)
                    @if(strlen($title) < 1 || !isset($title) || empty($title) || trim($title) === '')
                        <tr id="sp_nogroup">
                            <th scope="row" colspan="5">
                                Bez grupe
                            </th>
                    @else
                        <tr id="sp_{{ preg_replace('/[^a-z0-9.]+/i', '-', $title) }}">
                            <th scope="row" colspan="5">{{ $title }}</th>
                    @endif
                        </tr>
                        @foreach($parts as $part)
                        <tr>
                            <th scope="row"><small>{{ $part -> storage_number }}</small></th>
                            <td class="text-nowrap"><small>{{ $part -> description }}</small></td>
                            <td class="text-nowrap"><small>{{ $part -> catalogue_number }}</small></td>
                            <td class="text-nowrap">
                                @if(isset($part -> file_fileurl))
                                <a href="{{ URL::asset($part -> file_fileurl) }}" title="{{ $part -> file_filename}}  //  {{ number_format(round($part -> file_filesize/1024, 0), 0, '.', ' ') }}kB" >
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                                        <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </a>
                                @else
                                    <a href="#" title="Nema pridruženog dokumenta">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="gray" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                                            <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                                            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </a>
                                @endif

                                <a href="{{ route('neworder', [$position -> id, $part -> id, $part -> amount])}}" title="Dodaj u potencijalnu narudžbu!">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                                        <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0v-2z"/>
                                        <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                    </svg>
                                </a>

                                <a href="{{ route('spareparts.edit', $part -> id)}}" title="Uredi rezervni dio">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                            </td>
                            <td class="text-right">
                                <small>{{ $part -> amount }} {{ $part -> unit}}</small>
                            </td>
                            <td class="text-right">
                                @if(!empty($part -> navision_zalihe))
                                    <small>{{ $part -> navision_zalihe }}</small>
                                @else
                                    <small>0</small>
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($part -> navision_jedinicni_trosak))
                                    <small>{{ round($part -> navision_jedinicni_trosak, 2)}}</small>
                                @else
                                    <small>0</small>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
