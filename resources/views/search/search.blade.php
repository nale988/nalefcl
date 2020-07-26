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
            <a href="{{ route('positions.show', $searchresult->id) }}" style="color: #000000; text-decoration: none;">
            <div class="row" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F8F9FA'">
                <div class="col-2" title="{{ $searchresult -> position }}" style="overflow: hidden; white-space:nowrap; text-overflow: ellipsis;">{{ $searchresult -> position }}</div>
                <div class="col" title="{{ $searchresult -> name }}" style="overflow: hidden; white-space:nowrap; text-overflow: ellipsis;">{{ $searchresult -> name }}</div>
                <div class="col-3" title="{{ $searchresult -> manufacturer }}" style="overflow: hidden; white-space:nowrap; text-overflow: ellipsis;">{{ $searchresult -> manufacturer }}</div>
                <div class="col-3" title="{{ $searchresult -> type }}" style="overflow: hidden; white-space:nowrap; text-overflow: ellipsis;">{{ $searchresult -> type }}</div>
            </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection
