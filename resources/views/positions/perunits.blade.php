@extends('layouts.app')
@section('content')
<div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
        <thead class="thead-inverse">
            <tr>
                <th scope="col" class="text-nowrap">Pozicija</th>
                <th scope="col" class="text-nowrap text-center">RN</th>
                <th scope="col" class="text-nowrap">Ime</th>
                <th scope="col" class="text-nowrap">Proizvođač</th>
                <th scope="col" class="text-nowrap">Tip</th>
            </tr>
            </thead>
            <tbody>
                @foreach($positions as $position)
                <tr>
                    <td scope="row" class="text-nowrap">
                        <a href="{{ route('positions.show', $position -> id) }}" class="btn btn-primary btn-sm btn-block">
                            {{ $position -> position }}
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('workorders', $position -> position)}}" class="btn btn-primary btn-sm">
                            @include('layouts.buttons.btnworkorder', ['color' => 'currentColor'])
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
@endsection
