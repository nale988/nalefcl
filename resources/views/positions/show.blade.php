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
                <div class="col-6">NaN</div>
            </div>
        </div>
    </div>
    <br />
    <div class="btn-group btn-block" role="group" arial-label="Mogućnosti">
            {{-- <a href="{{ route('workorders.create', $position ->id) }}" class="btn btn-success btn-sm">&nbsp;&nbsp;Novi nalog&nbsp;&nbsp;</a> --}}
            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#newrevision">Nova revizija</a>
            {{-- <a href="{{ route('troubleshootings.create', $position -> id) }}" class="btn btn-success btn-sm" >Nova PK</a>  --}}
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
        <a href="{{URL::asset($file -> url)}}" style="text-decoration:none; color:#000000;">
            <div class="row">
                <div class="col">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                        <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                      </svg>
                    {{ $file -> filename }}
                    <br />
                </div>
                <div class="col-2 text-right">
                    {{ number_format(round($file -> filesize/1024, 0), 0, '.', ' ') }}kB
                </div>
                <div class="col-2 text-right">
                    {{ date('d. m. Y.', strtotime($file -> created_at)) }}
                </div>
            </div>
        </a>
        @endforeach

    </div>
</div>
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
                    @if($title === "")
                        <a class="nav-link active" id="empty-tab" data-toggle="tab" href="#empty" role="tab" aria-controls="empty" aria-selected="true"><strong>Bez grupe</strong></a>
                    @else
                        <a class="nav-link active" id="{{ str_replace('', '-', $title) }}-tab" data-toggle="tab" href="#{{ str_replace(' ', '-', $title) }}" role="tab" aria-controls="{{ str_replace(' ', '-', $title) }}" aria-selected="true"><strong>{{ $title }}</strong></a>
                    @endif
                @else
                    <a class="nav-link" id="{{ str_replace(' ', '-', $title) }}-tab" data-toggle="tab" href="#{{ str_replace(' ', '-', $title) }}" role="tab" aria-controls="{{ str_replace(' ', '-', $title) }}" aria-selected="false"><strong>{{ $title }}</strong></a>
                @endif
            </li>
            @endforeach
            </ul>

            <div class="tab-content" id="myTabContent">
            @foreach($spareparts as $title=>$sparepartgrouped)
                @if($loop->first)
                    @if($title=== "")
                    <div class="tab-pane fade show active" id="empty" role="tabpanel" aria-labelledby="empty-tab">
                    @else
                    <div class="tab-pane fade show active" id="{{ str_replace(' ', '-', $title) }}" role="tabpanel" aria-labelledby="home-tab">
                    @endif
                @else
                <div class="tab-pane fade" id="{{ str_replace(' ', '-', $title) }}" role="tabpanel" aria-labelledby="{{ str_replace(' ', '-', $title) }}-tab">
                @endif
                <br />
                <div class="row">
                    <div class="col-1">Skl. broj</div>
                    <div class="col-4">Opis</div>
                    <div class="col-4">Kataloški broj</div>
                    <div class="col-1">Količina</div>
                    <div class="col-1">Magacin</div>
                    <div class="col-1">Vrsta</div>
                </div>
                <hr />
                @foreach($sparepartgrouped as $sparepart)
                    @if ($loop -> odd)
                        <div class="row" style="background-color:#ffffff;">
                    @else
                        <div class="row" style="background-color:#eeeeee;">
                    @endif
                            <div class="col-1  text-truncate">
                                <p>
                                <a href="{{ route('spareparts.edit', $sparepart -> id)}}" title="Uredi rezervni dio">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                {{ $sparepart -> storage_number }}
                                </p>
                            </div>

                            <div class="col-4 text-truncate">
                                {{ $sparepart -> description }}
                            </div>

                            <div class="col-3 text-truncate">
                                {{ $sparepart -> catalogue_number }}
                            </div>

                            <div class="col-1">
                            <a href="{{ URL::asset($sparepart -> fileurl) }}" title="{{ $sparepart -> filename}}  //  {{ number_format(round($sparepart -> filesize/1024, 0), 0, '.', ' ') }}kB" >
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                                    <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </a>
                            </div>

                            <div class="col-1 text-center  text-truncate" >
                                {{ $sparepart -> amount }} {{ $sparepart -> unit}}
                            </div>

                            <div class="col-1 text-right text-truncate">
                                {{ $sparepart -> zalihe }}
                            </div>

                            <div class="col-1 text-truncate" title="{{ $sparepart -> spare_part_type_description }}">
                                {{ $sparepart -> spare_part_type_description }}
                            </div>
                        </div>
                @endforeach
                </div>
            @endforeach
            </div>
            </div>
        </div>
    </div>
    </div>
@endif

<br />
<br />



<div class="card">
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
@endsection
