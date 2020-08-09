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
        @foreach($spareparts as $title=>$sparepartgrouped)
            @if(strlen($title) < 1 || !isset($title) || empty($title) || trim($title) === '')
                <div class="card card-header" id="heading-empty">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-empty" aria-expanded="false" aria-controls="collapse-empty">
                        Bez grupe
                    </button>
                </div>

                <div id="collapse-empty" class="collapse" aria-labelledby="heading-empty" data-parent="#accordion">
                    @foreach($sparepartgrouped->sortBy('storage_number') as $sparepart)
                            {{ $sparepart -> id}}
                    @endforeach
                </div>
            @else
                <div class="card card-header" id="heading-{{ str_replace(' ', '-', $title) }}">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{ str_replace(' ', '-', $title) }}" aria-expanded="false" aria-controls="collapse-{{ str_replace(' ', '-', $title) }}">
                        {{ $title }}
                    </button>
                </div>

                <div id="collapse-{{ str_replace(' ', '-', $title) }}" class="collapse" aria-labelledby="heading-{{ str_replace(' ', '-', $title) }}" data-parent="#accordion">
                    @foreach($sparepartgrouped->sortBy('storage_number') as $sparepart)
                            {{ $sparepart -> id}}
                    @endforeach
                </div>
            @endif
        @endforeach
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
