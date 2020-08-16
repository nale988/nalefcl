@extends('layouts.app')

@section('content')

@if(count($workorders)>0)
<br />
<div class="card">
    <div class="card-header">
        Radni nalozi za <a href="{{ route('positions.show', $selectedposition->id) }}"">{{ $selectedposition -> position }} - {{ $selectedposition -> name }}</a>
    </div>
    <div class="card-body">

        @foreach($workorders as $workorder)
        <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
            <div class="row">
                <div class="col">
                    {{ $workorder -> content }}
                </div>

                <div class="col-2 text-right">
                    {{ $workorder -> owner}}
                </div>
            </div>

            <div class="row text-muted">
                <div class="col-2">
                    {{ $workorder -> number }}
                </div>

                <div class="col">
                    {{ $workorder -> unit }}
                </div>

                <div class="col text-right">
                    @if($workorder -> intervention)
                        <span class="badge badge-light">Intervencija</span>
                    @endif
                    @if($workorder -> fix)
                        <span class="badge badge-light">Popravak izrada</span>
                    @endif
                    @if($workorder -> general_repair)
                        <span class="badge badge-light">Remont</span>
                    @endif
                    @if($workorder -> preventive_maintenance)
                        <span class="badge badge-light">Preventivni pregled</span>
                    @endif
                </div>

                <div class="col-2">
                    {{ date('d. m. Y.', strtotime($workorder -> date)) }}
                </div>

                <div class="col-2">
                    {{ date('d. m. Y.', strtotime($workorder -> date1)) }}
                </div>
                <div class="col-2 text-right">
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

@endsection
