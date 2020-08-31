@extends('layouts.app')
@section('content')

<nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-dark" style="z-index: 1;">
    <a class="navbar-brand" href="#">{{ $position -> position }}</a>

    @if(!empty($favorite))
        <a href="{{ route('favorite', $position->id) }}" class="navbar-brand" title="Dodaj kao omiljeni!">
            @include('layouts.buttons.btnfavoritefull', ['color' => 'white'])
        </a>
    @else
        <a href="{{ route('favorite', $position->id) }}" class="navbar-brand" title="Ukloni!">
            @include('layouts.buttons.btnfavoriteempty', ['color' => 'white'])
        </a>
    @endif

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse flex-wrap" id="navbarNav">
        <ul class="navbar-nav">
            <!-- karakteristike -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#cInfo" role="button" aria-expanded="false" aria-controls="cInfo">Karakteristike</a>
            </li>

            <!-- rezervni dijelovi -->
            @if($userrole -> spare_parts_view)
                @if(count($spareparts) > 0)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#cSpareParts" role="button" aria-expanded="false" aria-controls="cSpareParts">Rezervni dijelovi</a>
                </li>
                @endif
            @endif

            <!-- dokumentacija -->
            @if($userrole -> files_view)
                @if(count($position_files) > 0)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#cDocuments" role="button" aria-expanded="false" aria-controls="cDocuments">Dokumenti</a>
                </li>
                @endif
            @endif

            <!-- radni sati kompresora -->
            @if($userrole -> workhours_view)
                @if(count($workinghours) > 0)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#cCompressorWorkHours" role="button" aria-expanded="false" aria-controls="cCompressorWorkHours">Radni sati</a>
                </li>
                @endif
            @endif

            <!-- servisi kompresora -->
            @if($userrole -> services_view)
                @if(count($compressorservices) > 0)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#cCompressorServices" role="button" aria-expanded="false" aria-controls="cCompressorServices">Servisi</a>
                </li>
                @endif
            @endif

            <!-- servisi duvaljki -->
            @if($userrole -> services_view)
                @if(count($blowerservices) > 0)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#cBlowerServices" role="button" aria-expanded="false" aria-controls="cBlowerServices">Servisi</a>
                </li>
                @endif
            @endif

            <!-- napomene -->
            @if($userrole -> revisions_view)
                @if(count($revisions) > 0)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#cRevisions" role="button" aria-expanded="false" aria-controls="cRevisions">Napomene</a>
                </li>
                @endif
            @endif

            @if($userrole -> services_add || $userrole -> workhours_add  || $userrole -> workorders_add || $userrole -> lubrications_add || $userrole -> files_add)
                <a class="nav-link" data-toggle="collapse" href="#cAddNew" role="button" aria-expanded="false" aria-controls="cAddNew">Dodaj</a>
            @endif

            @if($userrole -> workorders_view)
            <li><a class="nav-link">//</a></li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('workorders', $position -> position)}}">Radni nalozi</a>
            </li>
            @endif
        </ul>
    </div>
</nav>

<br />
<!-- karakteristike -->
<div class="collapse" id="cInfo">
    @include('positions.inc.positioninfo')
</div>

<!-- rezervni dijelovi -->
@if($userrole -> spare_parts_view)
    @if(count($spareparts) > 0)
    <div class="collapse show" id="cSpareParts">
        <br />
        @include('positions.inc.spareparts')
    </div>
    @endif
@endif

<!-- dokumentacija -->
@if($userrole -> files_view)
    @if(count($position_files) > 0)
    <div class="collapse" id="cDocuments">
        <br />
        @include('positions.inc.documents')
    </div>
    @endif
@endif

<!-- radni sati kompresora -->
@if($userrole -> workhours_view)
    @if(count($workinghours) > 0)
    <div class="collapse" id="cCompressorWorkHours">
        <br />
        @include('positions.inc.compressorworkhours')
    </div>
    @endif
@endif

<!-- servisi kompresora -->
@if($userrole -> services_view)
    @if(count($compressorservices) > 0)
    <div class="collapse" id="cCompressorServices">
        <br />
        @include('positions.inc.compressorservices')
    </div>
    @endif
@endif

<!-- servisi duvaljki -->
@if($userrole -> services_view)
    @if(count($blowerservices) > 0)
    <div class="collapse" id="cBlowerServices">
        <br />
        @include('positions.inc.blowerservices')
    </div>
    @endif
@endif

<!-- napomene -->
@if($userrole -> revisions_view)
    @if(count($revisions) > 0)
    <div class="collapse" id="cRevisions">
        <br />
        @include('positions.inc.revisions')
    </div>
    @endif
@endif

@if($userrole -> services_add || $userrole -> workhours_add  || $userrole -> workorders_add || $userrole -> lubrications_add || $userrole -> files_add)
<div class="collapse" id="cAddNew">
    <br />
    @include('positions.inc.addnew')
</div>
@endif





@endsection
