<div class="accordion" id="aSpareParts">
@foreach($spareparts as $title=>$sparepart)
    <div class="card">
        @if(strlen($title) < 1 || !isset($title) || empty($title) || trim($title) === '')
            {{-- <a type="button" class="collapsed" data-toggle="collapse" data-target="#cEmpty" aria-expanded="true" aria-controls="cEmpty"> --}}
                <a data-toggle="collapse" class="collapsed" href="#cEmpty" role="button" aria-expanded="true" aria-controls="cEmpty">
                <div class="card-header bg-primary text-white " id="aEmpty">
                        Bez grupe
                        <span class="float-right">
                            <span class="table-danger text-wrap"><small style="color: #000">&nbsp;&nbsp;Nedostaje&nbsp;&nbsp;</small></span>
                            <span class="table-success text-wrap"><small style="color: #000">&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;</small></span>
                        </span>
                </div>
            </a>
                @if($loop->first)
                    <div id="cEmpty" class="collapse show" aria-labelledby="headingEmpty" data-parent="#aEmpty" data-parent="#aSpareParts">
                @else
                    <div id="cEmpty" class="collapse" aria-labelledby="headingEmpty" data-parent="#aEmpty" data-parent="#aSpareParts">
                @endif
        @else
            <a data-toggle="collapse" class="collapsed" href="#c{{ preg_replace('/[^a-z0-9.]+/i', '-', $title) }}" role="button" aria-expanded="false" aria-controls="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $title) }}">
                <div class="card-header bg-primary text-white" id="a{{ preg_replace('/[^a-z0-9.]+/i', '-', $title)}}">
                        Grupa: {{ $title }}
                        <span class="float-right">
                            <span class="table-danger text-wrap"><small style="color: #000">&nbsp;&nbsp;Nedostaje&nbsp;&nbsp;</small></span>
                            <span class="table-success text-wrap"><small style="color: #000">&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;</small></span>
                        </span>
                </div>
            </a>
                @if($loop->first)
                    <div id="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $title) }}" class="collapse show" aria-labelledby="h{{ preg_replace('/[^a-z0-9.]+/i', '-', $title) }}" data-parent="#aSpareParts">
                @else
                    <div id="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $title) }}" class="collapse" aria-labelledby="h{{ preg_replace('/[^a-z0-9.]+/i', '-', $title) }}" data-parent="#aSpareParts">
                @endif
        @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Skl. broj</th>
                                <th scope="col" class="text-nowrap">Opis</th>
                                <th scope="col" class="text-nowrap">Kat. broj</th>
                                <th scope="col" class="text-nowrap">Opcije</th>
                                <th scope="col" class="text-nowrap">Poz.</th>
                                <th scope="col" class="text-right">Količina</th>
                                <th scope="col" class="text-right">Magacin</th>
                                <th scope="col" class="text-right">Cijena</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($sparepart->sortBy('storage_number')->sortBy('position') as $part)
                            @if($part -> private_item && (!$userrole -> private_items || $part -> user_id <> $user -> id))
                                <tr style="display: none;">
                            @elseif($part -> critical_part && ($part -> navision_zalihe < $part -> amount))
                                <tr class="table-danger" title="Kritični dio">
                            @elseif($part -> critical_part && ($part -> navision_zalihe >= $part -> amount))
                                <tr class="table-success" title="Kritični dio">
                            @else
                                <tr>
                            @endif
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
                                    @endif

                                    @if($userrole -> spare_parts_order)
                                    <a href="{{ route('neworder', [$position -> id, $part -> id, $part -> amount])}}" title="Dodaj u potencijalnu narudžbu!">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                                            <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0v-2z"/>
                                            <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        </svg>
                                    </a>
                                    @endif

                                    @if(!empty($part -> info))
                                    <a href="{{ route('spareparts.show', $part -> id) }}" target="_blank" title="Sadži dodatne informacije">
                                        @include('layouts.buttons.btninfo', ['color' => 'currentColor'])
                                    </a>
                                    @endif

                                    <a href="#" title="{{ $part -> username }}">
                                        @include('layouts.buttons.btnuser', ['color' => 'currentColor'])
                                    </a>

                                    <a href="{{ route('spareparts.show', $part -> id) }}" target="_blank" title="Pogledaj rezervni dio">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                            <circle cx="8" cy="4.5" r="1"/>
                                          </svg>
                                    </a>
                                </td>
                                <td class="text-nowrap text-right"><small>{{ $part -> position }}</small></td>
                                <td class="text-nowrap text-right">
                                    <small>{{ $part -> amount }} {{ $part -> unit}}</small>
                                </td>
                                <td class="text-nowrap text-right">
                                    @if(!empty($part -> navision_zalihe))
                                        <small>{{ $part -> navision_zalihe }}</small>
                                    @else
                                        <small>0</small>
                                    @endif
                                </td>
                                <td class="text-nowrap text-right">
                                    @if(!empty($part -> navision_jedinicni_trosak))
                                        <small>{{ round($part -> navision_jedinicni_trosak, 2)}}</small>
                                    @else
                                        <small>0</small>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- card-body -->
          </div> <!-- collapse -->
    </div> <!-- card -->
@endforeach

</div>
