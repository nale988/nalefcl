@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header border-dark bg-dark text-white">
        Traženi pojam u rezervnim dijelovima: "{{ $searchquery }}"
    </div>
    <div class="card-body">
        <!-- TODO: Make mobile friendly -->
        @foreach($searchresults as $sparepart)
        <a href="{{ route('spareparts.edit', $sparepart -> id)}}" style="color: #000000; text-decoration: none;" >
            <div class="row">
                <div class="col-2 text-truncate">
                    {{ $sparepart -> storage_number }}
                </div>
                <div class="col-5 text-truncate">
                    {{ $sparepart -> description }}
                </div>
                <div class="col-5 text-truncate">
                    {{ $sparepart -> catalogue_number }}
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
