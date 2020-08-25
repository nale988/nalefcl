@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
    <div class="card">
        <div class="card-header border-dark bg-dark text-white">
            Pareto dijagram za tekuću godinu
        </div>
        <div class="card-body">
            @foreach($pareto as $position)
            @if($position ->totalworkorders = 2)
                @break;
            @endif
            <div class="row">
                <div class="col-3 text-right text-truncate">
                    <a href="{{ route('workorders', $position -> position)}}" style="color:#000000">
                        {{ $position -> position }}
                    </a>
                </div>
                <div class="col">
                    <div class="progress" style="height: 20px;">
                        @if($loop->first)
                            <div class="progress-bar bg-danger" role="progressbar" style="width:100%;" aria-valuenow="{{ $max = $position -> totalworkorders }}" aria-valuemin="0" aria-valuemax="{{ $max }}"></div>
                        @elseif($loop->last)
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ round(($position->totalworkorders/$max)*100, 0)}}%" aria-valuenow="{{ $position -> totalworkorders }}" aria-valuemin="0" aria-valuemax="{{ $max }}"></div>
                        @else
                            <div class="progress-bar" role="progressbar" style="width: {{ round(($position->totalworkorders/$max)*100, 0)}}%" aria-valuenow="{{ $position -> totalworkorders }}" aria-valuemin="0" aria-valuemax="{{ $max }}"></div>
                        @endif
                    </div>
                </div>
                <div class="col-1">
                    <strong>{{ $position -> totalworkorders }}</strong>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header bg-dark text-white">
                Posljednji nalozi Mašinskog održavanja
            </div>
            <div class="card-body">
                @foreach($workorders as $workorder)
                <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                <div class="row">
                    <div class="col-6 text-truncate" title="{{$workorder->number}}">{{ $workorder -> number }}</div>
                    <div class="col-6 text-muted text-right text-truncate">{{ $workorder -> owner }}</div>
                </div>
                <div class="row">
                    <div class="col text-truncate" title="{{ $workorder -> content }}">{{ $workorder -> content }}</div>
                </div>
                </a>
                @if(!$loop->last)
                    <hr />
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<br />

@if(count($myworkorders)>0)
<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header bg-dark text-white">
                Moji posljednji nalozi
            </div>
            <div class="card-body">
                @foreach($myworkorders as $workorder)
                <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                <div class="row">
                    <div class="col-6 text-truncate" title="{{$workorder->number}}">{{ $workorder -> number }}</div>
                    <div class="col-6 text-muted text-right text-truncate">{{ date('d. m. Y.', strtotime($workorder -> date)) }}</div>
                </div>
                <div class="row">
                    <div class="col text-truncate" title="{{ $workorder -> content }}">{{ $workorder -> content }}</div>
                </div>
                </a>
                @if(!$loop->last)
                    <hr />
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
@endsection
