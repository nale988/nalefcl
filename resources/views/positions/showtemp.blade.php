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
                <div class="col-6">Rezervnih dijelova:</div>
                <div class="col-6">{{ count($spareparts->flatten())}}</div>
            </div>

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


<div class="card">
    <div class="card-header">
        Radni nalozi
    </div>
    <div class="card-body">
    @foreach($position -> spareparts as $sparepart)
        <div class="row">
            <div class="col-1">
                {{ $sparepart -> id}}
            </div>

            <div class="col-2">
                {{ $sparepart -> storage_number }}
            </div>

            <div class="col-6">
                {{ $sparepart -> description }}
            </div>

            <div class="col-3">
                {{ $sparepart -> spare_part_group }}
            </div>
        </div>
    @endforeach
    </div>
</div>

@if(count($workorders)>0)
<br />
<div class="card">
    <div class="card-header">
        Radni nalozi
    </div>
    <div class="card-body">

        @foreach($workorders as $workorder)
            <div class="row">
                <div class="col">
                    {{ $workorder -> content }}
                </div>

                <div class="col-2 text-right">
                    {{ $workorder -> owner}}
                </div>
            </div>

            <div class="row text-muted">
                <div class="col-2">
                    {{ $workorder -> number }}
                </div>

                <div class="col">
                    {{ $workorder -> unit }}
                </div>

                <div class="col-2">
                    {{ date('d. m. Y.', strtotime($workorder -> date)) }}
                </div>

                <div class="col-2">
                    {{ date('d. m. Y.', strtotime($workorder -> date1)) }}
                </div>
                <div class="col-1 text-right">
                    @if ($workorder -> finished ==1)
                        <span class="badge badge-success">Završeno</span>
                    @else
                        <span class="badge badge-danger">Nije završeno</span>
                    @endif
                </div>
            </div>

            @if(!$loop->last)
                <hr />
            @endif
        @endforeach

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
                {{ $revision -> description }}
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
            </div>

        </div>
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
            <div class="col-2">
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
@endsection
