@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header border-dark bg-dark text-white">
        <strong>Traženi pojam u napomenama: "{{ $searchquery }}"</strong>
    </div>
    <div class="card-body">
    <!-- TODO: Make mobile friendly -->
    @foreach($searchresults as $revision)
    <a href="{{ route('positions.show', $revision -> position_id) }}" style="color: #000000; text-decoration: none;" >
        <div class="row">
            <div class="col">
                <strong>{{$revision -> position -> position }} - {{$revision -> position -> name }}</strong>
            </div>
            <div class="col-2 text-right">
                {{ date('d. m. Y.', strtotime($revision -> created_at)) }}
            </div>
        </div>
        <div class="row">
            <div class="col text-truncate">
                {{ $revision -> description }}
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
