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

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <strong>{{ $workorder -> number }}</strong>
            </div>
            <div class="col text-right">
                @if($workorder -> preventive_maintenance)
                    <span class="badge badge-secondary">Preventivno održavanje</span>
                @endif

                @if($workorder -> intervention)
                    <span class="badge badge-secondary">Intervencija</span>
                @endif

                @if($workorder -> fix)
                    <span class="badge badge-secondary">Popravak / izrada</span>
                @endif

                @if($workorder -> general_repair)
                    <span class="badge badge-secondary">Remont</span>
                @endif
            </div>
        </div>
        <div class="row text-muted text-right"><div class="col">{{ $workorder -> owner }}</div></div>
    </div>
    <div class="card-body">
        <div class="row">
            <a href="{{ route('positions.show', $position -> id) }}" title="Otvori poziciju!" >
                <div class="col">{{ $position -> position }} - {{ $position -> manufacturer }} {{ $position -> name }}</div>
            </a>
        </div>
        <div class="row">
            <div class="col text-muted">{{ $units -> unit_number }} - {{ $units -> description }}</div>
        </div>
        <div class="row">
            <div class="col"><small>{{ date('d. m. Y.', strtotime($workorder -> date)) }}</small></div>
            <div class="col text-right"><small>{{ date('d. m. Y.', strtotime($workorder -> date1)) }}</small></div>
        </div>
        <hr />
        <div class="row"><div class="col"><strong>Sadržaj:</strong></div></div>
        <div class="row">
            <div class="col text-justify">
                {{ $workorder -> content }}
            </div>
        </div>
        @if(!empty($workorder -> comment ))
        <hr />
        <div class="row"><div class="col text-muted"><strong>Komentar:</strong></div></div>
        <div class="row">
            <div class="col text-justify text-muted">
                {{ $workorder -> comment }}
            </div>
        </div>
        @endif
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                {{ $workorder -> contractor }}
            </div>
            <div class="col-4 text-right">
                @if($workorder -> finished == 1)
                    <span class="badge badge-success">Završeno!</span>
                @else
                    <span class="badge badge-danger">Završeno!</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col text-muted"><small>
                {{ $workorder -> worker1 }}&nbsp;&nbsp;
                {{ $workorder -> worker2 }}&nbsp;&nbsp;
                {{ $workorder -> worker3 }}&nbsp;&nbsp;
                {{ $workorder -> worker4 }}</small>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
