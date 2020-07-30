@extends('layouts.app')

@section('content')
<div class="container">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('message'))
    <div class="alert alert-info">
        {{ Session::get('message') }}
    </div>
@endif

@if (Session::has('alert'))
    <div class="alert alert-danger">
        {{ Session::get('alert') }}
    </div>
@endif

@if(count($positions)>0)
<div class="card">
    <div class="card-header">
      Rezultati pretrage za pozicije
    </div>
    <div class="card-body">
        <div class="card-text">
            @foreach($positions as $position)
                <a href="{{ route('positions.show', $position->id) }}" style="color: #000000; text-decoration: none;" >
                    <div class="row">
                        <div class="col-2 text-truncate">
                            {{ $position -> position }}
                        </div>
                        <div class="col-5 text-truncate">
                            {{ $position -> name }}
                        </div>
                        <div class="col-5 text-truncate">
                            {{ $position -> manufacturer }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
        <div class="card-footer">
            <div class="text-right">
                Ukupno: {{ count($positions)}}
            </div>
        </div>
  </div>
@endif

@if(count($spareparts)>0)
<br />
<br />
<div class="card">
    <div class="card-header">
      Rezultati pretrage za rezervne dijelove
    </div>
    <div class="card-body">

        <div class="card-text">
            @foreach($spareparts as $sparepart)
                <a href="#" style="color: #000000; text-decoration: none;" >
                    <div class="row">
                        <div class="col-2 text-truncate">
                            {{ $sparepart -> storage_number }}
                        </div>
                        <div class="col-5 text-truncate">
                            {{ $sparepart -> description }}
                        </div>
                        <div class="col-5 text-truncate">
                            {{ $sparepart -> catalogue_number }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
        <div class="card-footer">
            <div class="text-right">
                Ukupno: {{ count($spareparts)}}
            </div>
    </div>
  </div>
@endif

@if(count($files)>0)
<br />
<br />
<div class="card">
    <div class="card-header">
      Rezultati pretrage za dokumente
    </div>
    <div class="card-body">
        <div class="card-text">
            @foreach($files as $file)
                <a href="#" style="color: #000000; text-decoration: none;" >
                    <div class="row">
                        <div class="col text-truncate">
                            {{ $file -> filename }}
                        </div>
                        <div class="col-2 text-truncate">
                            {{ $file -> filesize }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
        <div class="card-footer">
            <div class="text-right">
                Ukupno: {{ count($files)}}
            </div>
    </div>
  </div>
@endif


@if(count($revisions)>0)
<br />
<br />
<div class="card">
    <div class="card-header">
      Rezultati pretrage za napomene
    </div>
    <div class="card-body">
        <div class="card-text">
            @foreach($revisions as $revision)
                <a href="#" style="color: #000000; text-decoration: none;" >
                    <div class="row">
                        <div class="col text-truncate">
                            {{ $revision -> description }}
                        </div>
                        <div class="col-2 text-truncate">
                            {{ $revision -> date }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
        <div class="card-footer">
            <div class="text-right">
                Ukupno: {{ count($revisions)}}
            </div>
    </div>
  </div>
@endif
</div>
@endsection
