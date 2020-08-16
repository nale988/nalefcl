@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card border-success mb-3">
            <div class="card-header font-weight-bold">
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

<div class="row">
    <div class="col">
        <div class="card border-danger mb-3">
            <div class="card-header font-weight-bold">
                Posljednji nalozi
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

<div class="row">
    <div class="col">
        <div class="card border-success mb-3">
            <div class="card-header font-weight-bold">
                Pareto
            </div>
            <div class="card-body">
                @foreach($pareto as $item)
                <a class="nav-link" href="{{ route('workorders', $item -> position)}}">
                    <div class="row">
                        <div class="col-6">{{ $item -> position }}</div>
                        <div class="col-6">{{ $item -> totalworkorders }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
