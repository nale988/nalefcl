@extends('layouts.app')

@section('content')

<br />
<div class="card">
    <div class="card-header bg-dark text-white">
        Radni nalozi za <a href="{{ route('positions.show', $selectedposition->id) }}" style="color:#ffffff; text-decoration:none;">{{ $selectedposition -> position }} - {{ $selectedposition -> name }}</a>
    </div>
    <div class="card-body">
        @if(count($workorders) > 0)
            @foreach($workorders as $workorder)
            <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                <div class="row text-muted">
                    <div class="col">
                        <small>{{ $workorder -> number }}</small>
                    </div>
                    <div class="col text-right">
                        <small>{{ $workorder -> owner}}</small>
                    </div>

                </div>
                <div class="row">
                    <div class="col text-justify">
                        {{ $workorder -> content }}
                    </div>
                </div>
                <br />
                <div class="row text-muted">
                    <div class="col">
                        <small>Od: {{ date('d. m. y.', strtotime($workorder -> date)) }}</small>
                    </div>

                    <div class="col">
                        <small>Do: {{ date('d. m. y.', strtotime($workorder -> date1)) }}</small>
                    </div>

                    <div class="col text-right">
                        @if ($workorder -> finished ==1)
                            <span class="badge badge-success">Završeno</span>
                        @else
                            <span class="badge badge-danger">Nije završeno</span>
                        @endif
                    </div>
                </div>
            </a>
                @if(!$loop->last)
                    <hr />
                @endif
            @endforeach
        @else
            <span>Nema radnih naloga...</span>
        @endif
        <br />
        <div aria-label="Pagination" class="pagination pagination-sm justify-content-center">{!! $workorders->render() !!}</div>
    </div>
</div>

@endsection
