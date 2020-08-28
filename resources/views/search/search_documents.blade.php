@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header border-dark bg-dark text-white">
        <strong>Traženi pojam u dokumentima: "{{ $searchquery }}"</strong>
    </div>
    <div class="card-body">
    <!-- TODO: Make mobile friendly -->
    @foreach($searchresults as $file)
                <a href="{{URL::asset($file -> url)}}" style="color: #000000; text-decoration: none;" >
                    <div class="row">
                        <div class="col text-truncate">
                            {{ $file -> filename }}
                        </div>
                        <div class="col-2 text-right text-truncate">
                            {{ number_format(round($file -> filesize/1024, 0), 0, '.', ' ') }}kB
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
