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

@if(count($workorders)>0)
<br />
<div class="card">
    <div class="card-header">
        Radni nalozi
    </div>
    <div class="card-body">
        @foreach($workorders as $workorder)
        <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
            <div class="row text-muted">
                <div class="col">
                    <small>{{ $workorder -> number }}</small>
                </div>
            </div>
            <div class="row">
                <div class="col text-justify">
                    {{ $workorder -> content }}
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                    {{ $workorder -> owner}}
                </div>
            </div>
            <br />
            <div class="row text-muted">
                <div class="col text-truncate">
                    <small>{{ $workorder -> unit }}</small>
                </div>
            </div>

            <div class="row text-muted">
                <div class="col">
                    <small>Od: {{ date('d. m. YY.', strtotime($workorder -> date)) }}</small>
                </div>

                <div class="col">
                    <small>Do: {{ date('d. m. YY.', strtotime($workorder -> date1)) }}</small>
                </div>

                <div class="col text-right">
                    @if ($workorder -> finished ==1)
                        <span class="badge badge-success">Završeno</span>
                    @else
                        <span class="badge badge-danger">Nije završeno</span>
                    @endif
                </div>
            </div>
        </a>
            @if(!$loop->last)
                <hr />
            @endif
        @endforeach

    </div>
</div>
@endif

</div>
@endsection
