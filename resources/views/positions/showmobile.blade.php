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
    <div class= "col-12">
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
                    <div class="col-4">Godina:</div>
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
            </div>
        </div>
    </div>
</div>

<br />
<br />

<div class="row">
    <div class= "col-12">
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
    </div>
</div>

<div class="row">
    <div class="col text-center">
        <a href="{{ route('workorders', $position -> position)}}" class="btn btn-danger btn-sm">Radni nalozi</a>
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
        <a href="{{URL::asset($file -> url)}}" style="text-decoration:none; color:#000000;">
            <div class="row">
                <div class="col-12">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                        <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                      </svg>
                    {{ $file -> filename }}
                    <br />
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-left">
                    <small>{{ number_format(round($file -> filesize/1024, 0), 0, '.', ' ') }}kB</small>
                </div>
                <div class="col-6 text-right">
                    <small>{{ date('d. m. Y.', strtotime($file -> created_at)) }}</small>
                </div>
            </div>
        </a>
        <hr />
        @endforeach

    </div>
</div>
@endif

@if(count($spareparts)>0)
    <div id="accordion">
        <br />
        <div class="card p-3">
        @foreach($spareparts as $title=>$sparepartgrouped)
            @if(strlen($title) < 1 || !isset($title) || empty($title) || trim($title) === '')
                <div class="card card-header" id="heading-empty">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-empty" aria-expanded="false" aria-controls="collapse-empty">
                        Bez grupe
                    </button>
                </div>
                <div id="collapse-empty" class="collapse" aria-labelledby="heading-empty" data-parent="#accordion">
            @else
                <div class="card card-header" id="heading-{{ str_replace(' ', '-', $title) }}">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{ str_replace(' ', '-', $title) }}" aria-expanded="false" aria-controls="collapse-{{ str_replace(' ', '-', $title) }}">
                        {{ $title }}
                    </button>
                </div>
                <div id="collapse-{{ str_replace(' ', '-', $title) }}" class="collapse" aria-labelledby="heading-{{ str_replace(' ', '-', $title) }}" data-parent="#accordion">
            @endif

                @foreach($sparepartgrouped->sortBy('storage_number') as $sparepart)
                    <div class="row">
                        <div class="col-8  text-truncate" title="{{ $sparepart -> storage_number }}">
                        @if(strlen($sparepart -> storage_number) < 1)
                            <h5> - </h5>
                        @else
                            <h5>{{ $sparepart -> storage_number }}</h5>
                        @endif
                        </div>
                        @if($sparepart -> critical_part)
                        <div class="col-4 text-right">
                            <span class="badge badge-success">Kritično!</span>
                        </div>
                        @endif
                    </div>


                    <div class="row">
                        <div class="col text-truncate" title="{{ $sparepart -> description }}">
                            <u>{{ $sparepart -> description }}</u>
                        </div>
                    </div>
                    <br />
                    @if(strlen($sparepart -> catalogue_number) > 1)
                    <div class="row">
                        <div class="col text-truncate">
                            Kat. broj: {{ $sparepart -> catalogue_number }}
                        </div>
                    </div>
                    @endif

                    @if(strlen($sparepart -> order_number) > 1)
                    <div class="row">
                        <div class="col text-truncate">
                            Kat. broj: {{ $sparepart -> order_number }}
                        </div>
                    </div>
                    @endif

                    @if(strlen($sparepart -> info) > 1)
                    <div class="row">
                        <div class="col text-truncate">
                            Info: {{ $sparepart -> info }}
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-6 text-truncate" >
                            Količina: {{ $sparepart -> amount }} {{ $sparepart -> unit}}
                        </div>

                        <div class="col-6 text-right text-truncate">
                            Pozicija: {{ $sparepart -> position }}
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6 text-truncate">
                            {{ $sparepart -> spare_part_type_description }}
                        </div>
                        <div class="col-6 text-right text-truncate">
                            Magacin: {{ $sparepart -> navision_zalihe }}
                        </div>
                    </div>

                    <div class="row text-right">
                        <div class="col-12">
                        @if(!empty($sparepart -> info))
                                    <a href="#" data-toggle="modal" class="btn btn-primary" data-target="#modal-{{ $sparepart -> id }}" >
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
                                    @endif

                            @if(isset($sparepart -> fileurl))
                                <a href="{{ URL::asset($sparepart -> fileurl) }}" class="btn btn-primary" title="{{ $sparepart -> filename}}  //  {{ number_format(round($sparepart -> filesize/1024, 0), 0, '.', ' ') }}kB" >
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                                        <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </a>
                            @endif

                            <a href="{{ route('neworder', [$position -> id, $sparepart -> id, $sparepart -> amount])}}" class="btn btn-primary"  title="Dodaj u potencijalnu narudžbu!">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                                    <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0v-2z"/>
                                    <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                </svg>
                            </a>

                            <a href="{{ route('spareparts.edit', $sparepart -> id)}}" class="btn btn-primary"  title="Uredi rezervni dio">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <hr />
                    @endif
                @endforeach
                </div> <!-- div id collapse -->
        @endforeach
        </div>
    </div>

@endif

<br />
<br />

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
                {{ $revision -> description }}
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {{ date('d. m. Y.', strtotime($revision -> created_at)) }}
            </div>
            <div class="col-6 text-right">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-{{ $revision -> id }}" >
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
                    <a href="{{ URL::asset($file -> url ) }}" class="btn btn-primary" style="text-decoration:none; color:#ffffff;">
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
            </div>

        </div>
        <hr />
        @endforeach
    </div>
</div>
@endif

<br />
<br />
<div class="card">
    <div class="card-header">
        Dodaj dokumentaciju za poziciju
    </div>
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
            <div class="col-4">
                <button type="submit" class="btn btn-dark btn-sm">Dodaj dokument</button>
            </div>
        </div>
    </form>
    </div>
</div>

<br />
<br />

<div class="card">
    <div class="card-header">
        Napomene
    </div>

    <div class="card-body">
        <form class="m-2" method="post" action="{{ route('revisions.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="revision-content">Nova napomena</label>
                <textarea class="form-control" name="revision_description" rows="6"></textarea>
            </div>

            <input type="hidden" name="revision_position_id" value="{{ $position -> id }}">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <input id="file" type="file" name="file">
                    </div>
                </div>
                <div class="col-4 text-right">
                    <button type="submit" class="btn btn-primary" value="submit" name="revision_submit">Sačuvaj</button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
@endsection
