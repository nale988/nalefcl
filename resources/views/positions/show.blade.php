@extends('layouts.app')
@section('content')

<nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-primary" style="z-index: 1;">
    <a class="navbar-brand" href="#">{{ $position -> position }}</a>

    @if(!empty($favorite))
    <a href="{{ route('favorite', $position->id) }}" class="navbar-brand" title="Ukloni!">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="white" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
        </svg>
    </a>
    @else
        <a href="{{ route('favorite', $position->id) }}" class="navbar-brand" title="Dodaj kao omiljeni!">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
            </svg>
        </a>
    @endif
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#cInfo" role="button" aria-expanded="false" aria-controls="cInfo">Karakteristike</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('workorders', $position -> position)}}">Radni nalozi</a>
        </li>
        @if(count($spareparts)>0)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#cSpareParts" role="button" aria-expanded="false" aria-controls="cSpareParts">Rezervni dijelovi</a>
        </li>
        @endif
        @if(count($position -> files)>0)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#cDocuments" role="button" aria-expanded="false" aria-controls="cDocuments">Dokumenti</a>
        </li>
        @endif
        @if(count($workinghours)>0)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#cCompressorWorkHours" role="button" aria-expanded="false" aria-controls="cCompressorWorkHours">Radni sati</a>
        </li>
        @endif
        @if(count($compressorservices)>0)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#cCompressorServices" role="button" aria-expanded="false" aria-controls="cCompressorServices">Servisi</a>
        </li>
        @endif
        @if(count($blowerservices)>0)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#cBlowerServices" role="button" aria-expanded="false" aria-controls="cBlowerServices">Servisi</a>
        </li>
        @endif
        @if(count($revisions)>0)
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#cRevisions" role="button" aria-expanded="false" aria-controls="cRevisions">Napomene</a>
        </li>
        @endif
        <a class="nav-link" data-toggle="collapse" href="#cAddNew" role="button" aria-expanded="false" aria-controls="cAddNew">Dodaj novo</a>
      </ul>
    </div>
  </nav>

<br />
<div class="collapse" id="cInfo">
    @include('positions.include_positioninfo')
</div>

@if(count($spareparts)>0)
<div class="collapse show" id="cSpareParts">
    <br />
    @include('positions.include_spareparts_table')
</div>
@endif

@if(count($position -> files)>0)
<div class="collapse" id="cDocuments">
    <br />
    @include('positions.include_documents')
</div>
@endif

@if(count($workinghours)>0)
<div class="collapse" id="cCompressorWorkHours">
    <br />
    @include('positions.include_compressorworkhours')
</div>
@endif

@if(count($compressorservices)>0)
<div class="collapse" id="cCompressorServices">
    <br />
    @include('positions.include_compressorservices')
</div>
@endif

@if(count($blowerservices)>0)
<div class="collapse" id="cBlowerServices">
    <br />
    @include('positions.include_blowerservices')
</div>
@endif

@if(count($revisions)>0)
<div class="collapse" id="cRevisions">
    <br />
    @include('positions.include_revisions')
</div>
@endif

<div class="collapse" id="cAddNew">
    <br />
    @include('positions.include_addnew')
</div>

@endsection
