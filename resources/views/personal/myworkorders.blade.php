@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-dark text-white"><strong>Moji nalozi</strong></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-inverse">
                    <tr>
                        <th scope="col" class="text-nowrap">RN</th>
                        <th scope="col" class="text-nowrap text-center">Pozicija</th>
                        <th scope="col" class="text-nowrap">Datum</th>
                        <th scope="col" class="text-nowrap">Sadržaj</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($myworkorders as $workorder)
                        @if($workorder -> finished == 0)
                        <tr class="table-danger">
                        @else
                        <tr>
                        @endif
                            <td  class="text-nowrap">
                                <small><strong>
                                    <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                                        {{ $workorder -> number }}
                                    </a>
                                </strong></small>
                            </td>
                            <td class="text-nowrap text-center">
                                <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                                <small>{{ $workorder -> position }}</small>
                                </a>
                            </td>
                            <td class="text-nowrap">
                                <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                                <small>{{ date('d. m. y.', strtotime($workorder -> date)) }} - {{ date('d. m. y.', strtotime($workorder -> date1)) }}</small>
                                </a>
                            </td>
                            <td >
                                <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                                    <small>{{ $workorder -> content }}</small>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
        <br />
        <div aria-label="Pagination" class="pagination pagination-sm justify-content-center">{!! $myworkorders->render() !!}</div>
    </div>
    <div class="card-footer bg-dark text-white">
        <span class="float-right">Ukupno {{ $myworkorderscount }} naloga</span>
    </div>
</div>
@endsection
