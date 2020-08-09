@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col" id="search">
    <div class="card bg-light mb-3">
        <div class="card-header font-weight-bold">
            Rezultati pretrage
        </div>
        <div class="card-body">
            @foreach($searchresults as $searchresult)
            <a href="{{ route('positions.show', $searchresult->id) }}"  style="color: #000000; text-decoration: none;">
                    <div class="row" >
                        <div class="col-12 text-truncate" ><strong>{{ $searchresult -> position }}</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-truncate" >&nbsp;&nbsp;&nbsp;{{ $searchresult -> name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-truncate" >&nbsp;&nbsp;&nbsp;{{ $searchresult -> manufacturer }}</div>
                    </div>
                </span>
            </a>
            @if(!$loop->last)
                <hr />
            @endif
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection
