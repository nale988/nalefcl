@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header border-dark bg-dark text-white">
        <strong>Pretraga pozicija</strong>
    </div>
    <div class="card-body">
        @foreach($searchresults as $position)
            <a href="{{ route('positions.show', $position->id) }}" style="color: #000000; text-decoration:none;">
                <div class="row">
                    <div class="col-sm-2 text-truncate">
                        <strong>{{ $position -> position }}</strong>
                    </div>
                    <div class="col-sm-4 text-truncate">
                        {{ $position -> name }}
                    </div>
                    <div class="col-sm text-truncate">
                        {{ $position -> manufacturer }}
                    </div>
                    <div class="col-sm text-truncate">
                        {{ $position -> type }}
                    </div>
                </div>
            </a>
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
