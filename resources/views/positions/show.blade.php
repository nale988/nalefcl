@extends('layouts.app')

@section('content')
<div class="container">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('message'))
    <div class="alert alert-info">
        {{ Session::get('message') }}
    </div>
@endif

@if (Session::has('alert'))
    <div class="alert alert-danger">
        {{ Session::get('alert') }}
    </div>
@endif

<div class= "row">
<div class= "col-8">
    <div class="card">
        <div class="card-header">
            <strong>{{ $position -> position }}</strong> - {{ $position -> name }}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-4">Tip:</div>
                <div class="col">{{ $position -> type }}</div>
            </div>

            <div class="row">
                <div class="col-4">Proizvođač:</div>
                <div class="col">{{ $position -> manufacturer }}</div>
            </div>

            <div class="row">
                <div class="col-4">Godina proizvodnje:</div>
                <div class="col">{{ $position -> year }}</div>
            </div>

            <div class="row">
                <div class="col-4">Kapacitet:</div>
                <div class="col">{{ $position -> capacity }} {{ $position -> capacity1 }}</div>
            </div>

            <div class="row">
                <div class="col-4">Brzina:</div>
                <div class="col">{{ $position -> speed }} {{ $position -> speed1 }}</div>
            </div>

            <div class="row">
                <div class="col-4">Snaga:</div>
                <div class="col">{{ $position -> power }} {{ $position -> power1 }}</div>
            </div>
            <hr />
            <div class="row">
                <div class="col-4">Vrsta uređaja:</div>
                <div class="col">{{ $position -> devicetype -> type }}</div>
            </div>
        </div>
    </div>
</div>

<div class= "col-4">
    <div class="card">
        <div class="card-header">
            Statistika
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6">Dokumenata:</div>
                <div class="col-6">{{ count($position -> files)}}</div>
            </div>

            <div class="row">
                <div class="col-6">Napomena:</div>
                <div class="col-6">{{ count($revisions)}}</div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col text-center">
            <a href="{{ route('workorders', $position -> position)}}" class="btn btn-danger btn-sm">Radni nalozi</a>
        </div>
    </div>
</div>
</div>


@if(count($position -> files)>0)
<br />
<div class="card">
    <div class="card-header">
        Prateći dokumenti
    </div>
    <div class="card-body">

        @foreach($position -> files as $file)
            <div class="row">
                <div class="col">
                    <a href="{{URL::asset($file -> url)}}" style="text-decoration:none; color:#000000;">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                            <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        {{ $file -> filename }}
                    </a>
                </div>

                <div class="col-2 text-right">
                    {{ number_format(round($file -> filesize/1024, 0), 0, '.', ' ') }}kB
                </div>

                <div class="col-2 text-right">
                    {{ date('d. m. Y.', strtotime($file -> created_at)) }}
                    <a href="{{ route('removepositionfile', $file -> id) }}" title="Ukloni dokument!">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-diamond" fill="red" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endif

@if($position -> devicetype -> id == 3)
    @if(count($workinghours)>0)
    <br />
    <br />
    <div class="card">
        <div class="card-header">
            Radni sati kompresora
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">Datum</div>
                <div class="col-2 text-right">Radni sati:</div>
                <div class="col-2 text-right">Opterećeni sati:</div>
                <div class="col-2 text-right">Startovi motora:</div>
                <div class="col text-truncate">Komentar</div>
            </div>
            <hr />
            @foreach($workinghours as $workinghour)
            <div class="row">
                <div class="col-2">{{ date('d. m. Y.', strtotime($workinghour -> date)) }}</div>
                <div class="col-2 text-right">{{ $workinghour -> total }}h</div>
                <div class="col-2 text-right">{{ $workinghour -> loaded }}h</div>
                <div class="col-2 text-right">{{ $workinghour -> starts }} </div>
                <div class="col text-truncate">{{ $workinghour -> comment }}</div>
            </div>
            @endforeach
        </div>
        <div class="card-footer">
        </div>
    </div>
    @endif
@endif

@if($position -> devicetype -> id == 3)
    @if(count($compressorservices) > 0)
    <br />
    <br />
    <div class="card">
        <div class="card-header">
            Servisi kompresora
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">Datum</div>
                <div class="col-2 text-right">Tip:</div>
                <div class="col-2 text-right">Radni sati:</div>
                <div class="col text-truncate">Komentar</div>
            </div>
            <hr />
            @foreach($compressorservices as $compressorservice)
            <div class="row">
                <div class="col-2">{{ date('d. m. Y.', strtotime($compressorservice -> date)) }}</div>
                <div class="col-2 text-right"><strong>{{ $compressorservice -> type }}</strong></div>
                <div class="col-2 text-right">{{ $compressorservice -> total }}h</div>
                <div class="col text-truncate">{{ $compressorservice -> comment }}</div>
            </div>
            @endforeach
        </div>
        <div class="card-footer">
        </div>
    </div>
    @endif
@endif

@if(count($spareparts)>0)
    <br />
    <br />
    <div class="row">
    <div class= "col-12">
        <div class="card">
            <div class="card-header">
                Rezervni dijelovi
            </div>

            <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach($spareparts as $title=>$sparepart)
            <li class="nav-item">
                @if($loop->first)
                    @if(strlen($title) < 1 || !isset($title) || empty($title) || trim($title) === '')
                        <a class="nav-link active" id="empty-tab" data-toggle="tab" href="#empty" role="tab" aria-controls="empty" aria-selected="true"><strong>Bez grupe</strong></a>
                    @else
                        <a class="nav-link active" id="{{ str_replace('', '-', $title) }}-tab" data-toggle="tab" href="#{{ str_replace(' ', '-', $title) }}" role="tab" aria-controls="{{ str_replace(' ', '-', $title) }}" aria-selected="true"><strong>{{ $title }}</strong></a>
                    @endif
                @else
                    @if(strlen($title) < 1 || !isset($title) || empty($title) || trim($title) === '')
                        <a class="nav-link" id="empty-tab" data-toggle="tab" href="#empty" role="tab" aria-controls="empty" aria-selected="false"><strong>Bez grupe</strong></a>
                    @else
                        <a class="nav-link" id="{{ str_replace('', '-', $title) }}-tab" data-toggle="tab" href="#{{ str_replace(' ', '-', $title) }}" role="tab" aria-controls="{{ str_replace(' ', '-', $title) }}" aria-selected="false"><strong>{{ $title }}</strong></a>
                    @endif
                @endif
            </li>
            @endforeach
            </ul>

            <div class="tab-content" id="myTabContent">
            @foreach($spareparts as $title=>$sparepartgrouped)
                @if($loop->first)
                    @if(strlen($title) < 1 || !isset($title) || empty($title) || trim($title) === '')
                        <div class="tab-pane fade show active" id="empty" role="tabpanel" aria-labelledby="empty-tab">
                    @else
                        <div class="tab-pane fade show active" id="{{ str_replace(' ', '-', $title) }}" role="tabpanel" aria-labelledby="home-tab">
                    @endif
                @else
                    @if(strlen($title) < 1 || !isset($title) || empty($title) || trim($title) === '')
                        <div class="tab-pane fade" id="empty" role="tabpanel" aria-labelledby="empty-tab">
                    @else
                        <div class="tab-pane fade" id="{{ str_replace(' ', '-', $title) }}" role="tabpanel" aria-labelledby="home-tab">
                    @endif
                @endif
                    <br />
                    <div class="row">
                        <div class="col-1">Skl. broj</div>
                        <div class="col-3">Opis</div>
                        <div class="col-3">Kataloški broj</div>
                        <div class="col-2">Opcije</div>
                        <div class="col-1">Količina</div>
                        <div class="col-1">Magacin</div>
                        <div class="col-1">Pozicija</div>
                    </div>
                    <hr />
                        @foreach($sparepartgrouped->sortBy('storage_number') as $sparepart)
                            @if ($sparepart -> critical_part)
                                <strong>
                            @endif
                            @if ($loop -> odd)
                                <div class="row" style="background-color:#ffffff;">
                            @else
                                <div class="row" style="background-color:#eeeeee;">
                            @endif
                                    <div class="col-1  text-truncate" title="{{ $sparepart -> storage_number }}">
                                        {{ $sparepart -> storage_number }}
                                    </div>

                                    <div class="col-3 text-truncate" title="{{ $sparepart -> description }}">
                                        {{ $sparepart -> description }}
                                    </div>

                                    <div class="col-3 text-truncate" title="{{ $sparepart -> catalogue_number }}">
                                        {{ $sparepart -> catalogue_number }}
                                    </div>

                                    <div class="col-2">
                                        @if(!empty($sparepart -> info))
                                            <a href="#" data-toggle="modal" data-target="#modal-{{ $sparepart -> id }}" >
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-heading" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                  <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                  <path fill-rule="evenodd" d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                                  <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1z"/>
                                            </svg>
                                        </a>

                                        <div class="modal fade col" id="modal-{{ $sparepart -> id }}" tabindex="-1" role="dialog" aria-labelledby="desc-{{ $sparepart -> id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="modal-{{ $sparepart -> id }}">Detalji napomene</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body d-flex text-justify">
                                                    {!! $sparepart -> info !!}
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        @else
                                              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-heading" fill="gray" xmlns="http://www.w3.org/2000/svg">
                                                  <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                  <path fill-rule="evenodd" d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                                  <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1z"/>
                                            </svg>
                                        @endif

                                        @if(isset($sparepart -> file_fileurl))
                                            <a href="{{ URL::asset($sparepart -> file_fileurl) }}" title="{{ $sparepart -> file_filename}}  //  {{ number_format(round($sparepart -> file_filesize/1024, 0), 0, '.', ' ') }}kB" >
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                                                    <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                                                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                                </svg>
                                            </a>
                                        @else
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="gray" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                                                <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                            </svg>
                                        @endif

                                        <a href="{{ route('neworder', [$position -> id, $sparepart -> id, $sparepart -> amount])}}" title="Dodaj u potencijalnu narudžbu!">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                                                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0v-2z"/>
                                                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                            </svg>
                                        </a>

                                        <a href="{{ route('spareparts.edit', $sparepart -> id)}}" title="Uredi rezervni dio">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </a>
                                    </div>

                                    <div class="col-1 text-right  text-truncate" >
                                        <small>{{ $sparepart -> amount }} {{ $sparepart -> unit}}</small>
                                    </div>

                                    <div class="col-1 text-right text-truncate">
                                        @if(!empty($sparepart -> navision_zalihe))
                                            <small>{{ $sparepart -> navision_zalihe }}</small>
                                        @else
                                            <small>0</small>
                                        @endif
                                    </div>

                                    <div class="col-1 text-truncate" title="{{ $sparepart -> spare_part_type_description }}">
                                        <small>{{ $sparepart -> position }}</small>
                                    </div>
                                </div>
                        @if ($sparepart -> critical_part)
                            </strong>
                        @endif
                        @endforeach
                        </div>
                    @endforeach
            </div>
            </div>
        </div>
    </div>
    </div>
@endif

@if(count($revisions)>0)
<br />
<br />
<div class="card">
    <div class="card-header">
        Napomene za poziciju
    </div>
    <div class="card-body">
        @foreach($revisions as $revision)
        <div class="row">
            <div class="col text-truncate ">
                {{ strip_tags($revision -> description) }}
            </div>

            <div class="col-2">
                {{ date('d. m. Y.', strtotime($revision -> created_at)) }}
                &nbsp;&nbsp;

                <a href="#" data-toggle="modal" data-target="#modal-{{ $revision -> id }}" >
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-medical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5A.5.5 0 0 1 8 4zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </a>

                <div class="modal fade col" id="modal-{{ $revision -> id }}" tabindex="-1" role="dialog" aria-labelledby="desc-{{ $revision -> id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modal-{{ $revision -> id }}">Detalji napomene</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body d-flex text-justify">
                            {!! $revision -> description !!}
                        </div>
                        <div class="modal-footer">
                            @if(count($revision -> files) > 0)
                                @foreach($revision -> files as $file)
                                    <a class="btn btn-dark" href="{{ URL::asset($file -> url ) }}">{{ $file -> filename }}</a>
                                @endforeach
                            @endif
                          &nbsp;&nbsp;
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                        </div>
                      </div>
                    </div>
                  </div>

                @if(count($revision -> files) > 0)
                @foreach($revision -> files as $file)
                    <a href="{{ URL::asset($file -> url ) }}" style="text-decoration:none; color:#000000;">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                            <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </a>
                @endforeach
                @else
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                        <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                @endif

                <a href="{{ route('revisions.edit', $revision -> id)}}">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<br />
<div class="card">
    <div class="card-header">
        <a data-toggle="collapse" href="#collapsePositionFiles"  role="button" aria-expanded="false" aria-controls="collapsePositionFiles">
            Dodaj dokumentaciju za poziciju
        </a>
    </div>
    <div class="collapse" id="collapsePositionFiles">
        <div class="card-body">
        {{-- enctype attribute is important if your form contains file upload --}}
        {{-- Please check https://www.w3schools.com/tags/att_form_enctype.asp for further info --}}
        <form class="m-2" method="post" action="{{ route('uploadpositionfile') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="position_id" value="{{ $position -> id }}" />
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input id="file" type="file" name="file">
                    </div>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-dark btn-sm">Dodaj dokument</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

@if($position -> devicetype -> id == 3)
    @if($userrole -> workhours == 1)
    <br />
    <div class="card">
        <div class="card-header">
            <a data-toggle="collapse" href="#collapseCompressorWorkHours"  role="button" aria-expanded="false" aria-controls="collapseCompressorWorkHours">
            Dodaj radne sate za kompresor
            </a>
        </div>
        <div class="collapse" id="collapseCompressorWorkHours">
            <div class="card-body">
            <form class="m-2" method="post" action="{{ route('storeworkinghours') }}">
                @csrf
                <input type="hidden" name="position_id" value="{{ $position -> id }}" />
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            @if(!empty($lastworkinghours->total))
                            <input type="text" name="total" class="form-control" placeholder="{{ $lastworkinghours -> total }}h" />
                            @else
                            <input type="text" name="total" class="form-control" placeholder="Radni sati" />
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            @if(!empty($lastworkinghours->loaded))
                                <input type="text" name="loaded" class="form-control" placeholder="{{ $lastworkinghours -> loaded}}h" />
                            @else
                                <input type="text" name="loaded" class="form-control" placeholder="Opterećeni sati" />
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            @if(!empty($lastworkinghours->starts))
                                <input type="text" name="starts" class="form-control" placeholder="{{ $lastworkinghours -> starts }}" />
                            @else
                                <input type="text" name="starts" class="form-control" placeholder="Startovi motora" />
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="description">Komentar:</label>
                            <textarea class="form-control" name="description" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="date">Datum mjerenja:</label>
                            <input type="date" name="date" class="form-control" value="{{ now()->format('Y-m-d') }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-dark btn-sm">Sačuvaj radne sate</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    @endif
@endif

@if($position -> devicetype -> id == 3)
    @if($userrole -> services == 1)
    <br />
    <div class="card">
        <div class="card-header">
            <a data-toggle="collapse" href="#collapseCompressorService"  role="button" aria-expanded="false" aria-controls="collapseCompressorService">
                Dodaj servis za kompresor
            </a>
        </div>
        <div class="collapse" id="collapseCompressorService">
            <div class="card-body">
            <form class="m-2" method="post" action="{{ route('storecompressorservice') }}">
                @csrf
                <input type="hidden" name="position_id" value="{{ $position -> id }}" />
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <input type="text" name="total" class="form-control" placeholder="Radni sati" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input type="text" name="type" class="form-control" placeholder="Vrsta servisa" />
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <input type="date" name="date" class="form-control" value="{{ now()->format('Y-m-d') }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="description">Komentar:</label>
                            <textarea class="form-control" name="description" rows="1"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-dark btn-sm">Sačuvaj servis</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    @endif
@endif

<br />

<div class="card">
    <div class="card-header">
        <a data-toggle="collapse" href="#collapseRevisions"  role="button" aria-expanded="false" aria-controls="collapseRevisions">
            Napomene
        </a>
    </div>
    <div class="collapse" id="collapseRevisions">
        <div class="card-body">
            <form class="m-2" method="post" action="{{ route('revisions.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="revision-content">Nova napomena</label>
                    <textarea class="form-control" name="revision_description" rows="6"></textarea>
                </div>

                <input type="hidden" name="revision_position_id" value="{{ $position -> id }}">
                <div class="row">
                    <div class="col">&nbsp;</div>
                    <div class="col-4">
                        <div class="form-group">
                            <input id="file" type="file" name="file">
                        </div>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary" value="submit" name="revision_submit">Sačuvaj</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
@endsection
