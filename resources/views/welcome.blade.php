@extends('layouts.app')

@section('content')

{{-- <br />
<br />
<div id="myfirstchart" style="height: 250px;"></div>
<br />
<br /> --}}

@auth
@if($userrole -> workorders_view)
@if($usersettings -> show_home_pareto)
@include('layouts.snippets.headerleft', ['title' => 'Pareto dijagram', 'subtitle' => 'za prethodnu godinu...'])
@foreach($pareto as $position)
<div class="row">
    <div class="col">
        <div class="progress my-1" style="height: 20px;">
            @if($loop->first)
                <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width:100%;" aria-valuenow="{{ $max = $position -> totalworkorders }}" aria-valuemin="0" aria-valuemax="{{ $max }}">
                    <a href="{{ route('workorders', $position -> position)}}" class="text-left ml-2 text-white" style="color:#000000">
                        <strong>{{ $position -> position }}</strong>
                        <span class="float-right mr-2 text-white">{{ $position -> totalworkorders }}</span>
                    </a>
                </div>
            @elseif($loop->last)
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ round(($position->totalworkorders/$max)*100, 0)}}%" aria-valuenow="{{ $position -> totalworkorders }}" aria-valuemin="0" aria-valuemax="{{ $max }}">
                    <a href="{{ route('workorders', $position -> position)}}" class="text-left ml-2 text-white"  style="color:#000000">
                        <strong>{{ $position -> position }}</strong>
                        <span class="float-right mr-2 text-white">{{ $position -> totalworkorders }}</span>
                    </a>
                </div>
            @else
                <div class="progress-bar" role="progressbar" style="width: {{ round(($position->totalworkorders/$max)*100, 0)}}%" aria-valuenow="{{ $position -> totalworkorders }}" aria-valuemin="0" aria-valuemax="{{ $max }}">
                    <a href="{{ route('workorders', $position -> position)}}" class="text-left ml-2 text-white"  style="color:#000000">
                        <strong>{{ $position -> position }}</strong>
                        <span class="float-right mr-2 text-white">{{ $position -> totalworkorders }}</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endforeach
<br />
<br />
@endif

@include('layouts.snippets.headerleft', ['title' => 'Posljednji nalozi', 'subtitle' => 'mašinskog održavanja'])

<div class="table-responsive">
    <table class="table table-sm table-hover">
            <thead>
            <tr>
                <th>RN</th>
                <th>Sadržaj</th>
                <th>Datum</th>
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
                   {{ date('d. m. Y.', strtotime($workorder -> date)) }}
                </td>
                <td class="text-nowrap">
                    {{ $workorder -> owner }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@if(count($myworkorders)>0)
<br />
<br />
@include('layouts.snippets.headerleft', ['title' => 'Posljednji nalozi', 'subtitle' => '(lični)'])

<div class="table-responsive">
    <table class="table table-sm table-hover">
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

{{-- <script>
new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [{{ $pareto2 }}],
  // The name of the data record attribute that contains x-values.
  xkey: {{ $pareto2 -> position }},
  // A list of names of data record attributes that contain y-values.
  ykeys: [{{ $pareto2 -> totalworkorders }}],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});
</script> --}}

@endsection
