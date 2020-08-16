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

<div class="row">
    <div class="col-12">
        <div class="card border-primary mb-3">
            <div class="card-header font-weight-bold">
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
</div>

<div class="row">
    <div class="col-12">
    <div class="card border-success mb-3">
        <div class="card-header font-weight-bold">
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

</div> <!-- CONTAINER -->
@endsection
