@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-dark text-white">
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

            <div class="row">
                <div class="col-12">
                    <small><div class="float-left">{{ $workorder -> owner }}</div></small>
                    <small><div class="float-right"><small>{{ date('d. m. y.', strtotime($workorder -> date)) }} - {{ date('d. m. y.', strtotime($workorder -> date1)) }}</small></div></small>
                </div>
            </div>
    </div>
    <div class="card-body">
        <div class="row">
            @if($position -> id <> 9999)
            <a href="{{ route('positions.show', $position -> id) }}" style="text-decoration: none; color: #000000" title="Otvori poziciju!" >
            @endif

                <div class="col">
                    <h5>{{ $position -> position }} - {{ $position -> manufacturer }} {{ $position -> name }}
                        <small class="text-muted">({{ $unit -> unit_number }} - {{ $unit -> description }})</small>
                    </h5>
                </div>

            @if($position -> id <> 9999)
            </a>
            @endif
        </div>
        <hr />

        <div class="row"><div class="col"><strong>Sadržaj:</strong></div></div>

        <div class="row">
            <div class="col text-justify">
                <p class="lead">{{ $workorder -> content }}</p>
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
    <div class="card-footer bg-dark text-white">
        <div class="row">
            <div class="col">
                <h5>{{ $workorder -> contractor }}</h5>
            </div>
            <div class="col-4 text-right">
                @if($workorder -> finished == 1)
                    <span class="badge badge-success">Završeno!</span>
                @else
                    <span class="badge badge-danger">Nije završeno!</span>
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

@if(count($storagespendings)>0)
<br />
<div class="card">
    <div class="card-header bg-dark">
        <a style="color: #ffffff" data-toggle="collapse" href="#collapseStorageSpending" role="button" aria-expanded="false" aria-controls="collapseStorageSpending">
        Spisak trebovanja
        </a>
    </div>
        <div class="collapse" id="collapseStorageSpending">
            <div class="card">
                <div class="card-body">
                    @foreach($storagespendings as $storagespending)
                        <div class="row">
                            <div class="col-8 text-muted"><strong>{{ $storagespending -> storage_number }}</strong></div>
                            <div class="col-4 text-right">{{ $storagespending -> pieces }}kom</div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-truncate">{{ $storagespending -> title }}</div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            <small><div class="float-left text-muted">{{ $storagespending -> worker }}</div></small>
                            <small><div class="text-muted float-right">{{ date('d. m. y.', strtotime($storagespending -> date)) }}</div></small>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <hr />
                        @endif
                    @endforeach
                </div>
                <div class="card-footer bg-dark text-white">
                    Ukupno: {{ count($storagespendings) }}
                </div>
            </div>
        </div>
</div>
@endif
@endsection
