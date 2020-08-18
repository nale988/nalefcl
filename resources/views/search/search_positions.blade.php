@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header border-dark bg-dark text-white">
        <strong>Pretraga pozicija</strong>
    </div>
    <div class="card-body">
        @foreach($searchresults as $position)

                <div class="row">
                    <a href="{{ route('positions.show', $position->id) }}" style="color: #000000; text-decoration:none;">
                    <div class="col-sm text-truncate">
                        <strong>{{ $position -> position }}</strong>
                    </div>
                    <div class="col-sm text-truncate">
                        {{ $position -> name }}
                    </div>
                    <div class="col-sm text-truncate">
                        {{ $position -> manufacturer }}
                    </div>
                    </a>
                </div>
                <div class="row text-muted">
                    <div class="col-sm text-truncate">
                        <div class="float-left">{{ $position -> type }}</div>
                        <div class="float-right"><a href="{{ route('workorders', $position -> position)}}" class="btn btn-secondary btn-sm">Radni nalozi</a></div>
                    </div>
                </div>
        @if(!$loop->last)
            <hr />
        @endif
        @endforeach
    </div>
    <div class="card-footer border-dark bg-dark text-white">
        Rezultata: {{ count($searchresults) }}
    </div>
</div>

@endsection
