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
            @foreach($sparepartgrouped as $sparepart)
                @if ($loop -> odd)
                    <div class="row" style="background-color:#ffffff;">
                @else
                    <div class="row" style="background-color:#eeeeee;">
                @endif
                        <div class="col-1  text-truncate">
                            {{ $sparepart -> storage_number }}
                        </div>

                        <div class="col-4 text-truncate">
                            {{ $sparepart -> description }}
                        </div>

                        <div class="col-4 text-truncate">
                            {{ $sparepart -> catalogue_number }}
                        </div>

                        <div class="col-1 text-center  text-truncate">
                            {{ $sparepart -> amount }} {{ $sparepart -> unit}}
                        </div>

                        <div class="col-1 text-right text-truncate">
                            {{ $sparepart -> zalihe }}
                        </div>

                        <div class="col-1 text-truncate">
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


</div>
@endsection