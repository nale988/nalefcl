@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-10">
        <div class="card">
            <div class="card-header border-dark bg-dark text-white">
                Posljednji nalozi
            </div>
            <div class="card-body">
                @foreach($workorders as $workorder)
                <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                    <div class="row">
                        <div class="col-2 text-truncate" title="{{$workorder->number}}">{{ $workorder -> number }}</div>
                        <div class="col text-truncate" title="{{ $workorder -> content }}">{{ $workorder -> content }}</div>
                        <div class="col-2 text-muted text-truncate">{{ $workorder -> owner }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="card">
            <div class="card-header border-dark bg-dark text-white">
                Pareto
            </div>
            <div class="card-body border-dark ">
                @foreach($pareto as $item)
                <a style="text-decoration: none; color: #000000;" href="{{ route('workorders', $item -> position)}}">
                    <div class="row">
                        <div class="col-8">
                            {{ $item -> position }}
                        </div>
                        <div class="col text-right">
                            {{ $item -> totalworkorders }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header border-dark bg-dark text-white">
            Moji posljednji nalozi
        </div>
        <div class="card-body">
            @foreach($myworkorders as $workorder)
            <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
            <div class="row">
                <div class="col-2 text-truncate" title="{{$workorder->number}}">{{ $workorder -> number }}</div>
                <div class="col text-truncate" title="{{ $workorder -> content }}">{{ $workorder -> content }}</div>
                <div class="col-2 text-muted text-right text-truncate">{{ date('d. m. Y.', strtotime($workorder -> date)) }}</div>
            </div>
            </a>
            @endforeach
        </div>
    </div>
    </div>
</div>

@endsection
