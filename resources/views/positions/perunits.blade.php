@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-dark text-white">Pozicije za <strong>{{ $unit -> unit_number }} - {{ $unit -> description }}</strong></div>

    <div class="card-body">
        <div class="card-text">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead class="thead-inverse">
                        <tr>
                            <th scope="col" class="text-nowrap">Pozicija</th>
                            <th scope="col" class="text-nowrap">Ime</th>
                            <th scope="col" class="text-nowrap">Proizvođač</th>
                            <th scope="col" class="text-nowrap">Tip</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($positions as $position)
                            <tr>
                                <td scope="row" class="text-nowrap">
                                    <a href="{{ route('positions.show', $position -> id) }}">
                                        {{ $position -> position }}
                                    </a>
                                </td>
                                <td class="text-nowrap">{{ $position -> name }}</td>
                                <td class="text-nowrap">{{ $position -> manufacturer }}</td>
                                <td class="text-nowrap">{{ $position -> type }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
