@extends('layouts.app')

@section('content')

@auth
@if($userrole -> workorders_view)
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-header border-dark bg-dark text-white">
            Pareto dijagram za tekuću godinu
        </div>
        <div class="card-body">
            @foreach($pareto as $position)
            <div class="row">
                <div class="col-1 text-right text-truncate">
                    <a href="{{ route('workorders', $position -> position)}}" style="color:#000000">
                        {{ $position -> position }}
                    </a>
                </div>
                <div class="col">
                    <div class="progress" style="height: 20px;">
                        @if($loop->first)
                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width:100%;" aria-valuenow="{{ $max = $position -> totalworkorders }}" aria-valuemin="0" aria-valuemax="{{ $max }}"></div>
                        @elseif($loop->last)
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ round(($position->totalworkorders/$max)*100, 0)}}%" aria-valuenow="{{ $position -> totalworkorders }}" aria-valuemin="0" aria-valuemax="{{ $max }}"></div>
                        @else
                            <div class="progress-bar" role="progressbar" style="width: {{ round(($position->totalworkorders/$max)*100, 0)}}%" aria-valuenow="{{ $position -> totalworkorders }}" aria-valuemin="0" aria-valuemax="{{ $max }}"></div>
                        @endif
                    </div>
                </div>
                <div class="col-1">
                    <strong>{{ $position -> totalworkorders }}</strong>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>

<br />

<h4>Posljednji nalozi <small class="text-muted">mašinskog održavanja</small></h4>
<div class="table-responsive">
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>RN</th>
                <th>Sadržaj</th>
                <th>Pokretač</th>
            </tr>
        </thead>
        <tbody>
        @foreach($workorders as $workorder)
            <tr>
                <td class="text-nowrap">
                    <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                    <strong>{{ $workorder -> number }}</strong>
                    </>
                </td>
                <td>
                    {{ $workorder -> content }}
                </td>
                <td class="text-nowrap">
                    {{ $workorder -> owner }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


<br />
@if(count($myworkorders)>0)
<h4>Posljednji nalozi <small class="text-muted">(lični)</small></h4>
<div class="table-responsive">
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>RN</th>
                <th>Sadržaj</th>
                <th>Datum</th>
            </tr>
        </thead>
        <tbody>
        @foreach($myworkorders as $workorder)
            <tr>
                <td class="text-nowrap">
                    <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                    <strong>{{ $workorder -> number }}</strong>
                    </>
                </td>

                <td>
                    {{ $workorder -> content }}
                </td>

                <td class="text-right text-nowrap">
                    {{ date('d. m. Y.', strtotime($workorder -> date)) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif
@endif
@endauth
@endsection
