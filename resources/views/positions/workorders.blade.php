@extends('layouts.app')

@section('content')

@if(count($workorders)>0)
<br />
<div class="card">
    <div class="card-header bg-dark text-white">
        Radni nalozi za <a href="{{ route('positions.show', $selectedposition->id) }}" style="color:#ffffff; text-decoration:none;">{{ $selectedposition -> position }} - {{ $selectedposition -> name }}</a>
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

                <div class="col-2">
                    {{ date('d. m. Y.', strtotime($workorder -> date)) }}
                </div>

                <div class="col-2">
                    {{ date('d. m. Y.', strtotime($workorder -> date1)) }}
                </div>
                <div class="col-1 text-right">
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
        <div class="card-footer bg-dark text-white">
            {{ count($workorders) }}
        </div>
    </div>
</div>
@endif

@endsection
