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
                @if(!$loop->last)
                    <hr />
                @endif
            @endforeach
        </div>
    </div>
        <div class="card-footer">
            <div class="text-right">
                <strong>Ukupno: {{ count($positions)}}</strong>
            </div>
        </div>
  </div>
@endif

@if(count($spareparttypes) > 0)
<br />
dd('test')
<br />
<div class="card">
    <div class="card-header">
        Rezultati pretrage za vrstu rezervnih dijelova
    </div>
    <div class="card-body">
        <div class="card-text">
        @foreach($spareparttypes as $spareparttype)
            <a href="{{ route('spareparts.edit', $spareparttype -> id)}}" style="color: #000000; text-decoration: none;" >
                <div class="row">
                    <div class="col-2 text-truncate">
                        {{ $spareparttype -> storage_number }}
                    </div>
                    <div class="col-5 text-truncate">
                        {{ $spareparttype -> description }}
                    </div>
                    <div class="col-5 text-truncate">
                        {{ $spareparttype -> catalogue_number }}
                    </div>
               </div>
            </a>
        @endforeach
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
                <a href="{{ route('spareparts.edit', $sparepart -> id)}}" style="color: #000000; text-decoration: none;" >
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
                @if(!$loop->last)
                    <hr />
                @endif
            @endforeach
        </div>
    </div>
        <div class="card-footer">
            <div class="text-right">
                <strong>Ukupno: {{ count($spareparts)}}</strong>
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
                <a href="{{URL::asset($file -> url)}}" style="color: #000000; text-decoration: none;" >
                    <div class="row">
                        <div class="col text-truncate">
                            {{ $file -> filename }}
                        </div>
                        <div class="col-2 text-right text-truncate">
                            {{ number_format(round($file -> filesize/1024, 0), 0, '.', ' ') }}kB
                        </div>
                    </div>
                </a>
                @if(!$loop->last)
                    <hr />
                @endif
            @endforeach
        </div>
    </div>
        <div class="card-footer">
            <div class="text-right">
                <strong>Ukupno: {{ count($files)}}</strong>
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
                <a href="{{ route('positions.show', $revision -> position_id) }}" style="color: #000000; text-decoration: none;" >
                    <div class="row">
                        <div class="col">
                            <strong>{{$revision -> position -> position }} - {{$revision -> position -> name }}</strong>
                        </div>
                        <div class="col-2 text-right">
                            {{ date('d. m. Y.', strtotime($revision -> created_at)) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-truncate">
                            {{ $revision -> description }}
                        </div>
                    </div>
                </a>
                @if(!$loop->last)
                    <hr />
                @endif
            @endforeach
        </div>
    </div>
        <div class="card-footer">
            <div class="text-right">
                <strong>Ukupno: {{ count($revisions)}}</strong>
            </div>
    </div>
  </div>
@endif

@if(count($navisions)>0)
<br />
<br />
<div class="card">
    <div class="card-header">
      Rezultati pretrage za Navision (baza: {{ date('d. m. Y.', strtotime($info -> navision))}})
    </div>
    <div class="card-body">
        <div class="card-text">
            @foreach($navisions as $navision)
                    <div class="row">
                        <div class="col">
                            <strong>{{ $navision -> br}}</strong> - {{ $navision -> opis }}
                        </div>
                        <div class="col-2 text-right">
                            {{ $navision -> zalihe }} {{ $navision -> jm_za_nabavu }}
                        </div>
                    </div>
                    @if($navision -> opis_2 <>"")
                    <div class="row">
                        <div class="col">
                            <small class="text-muted">Opis 2: {{ $navision -> opis_2 }}</small>
                        </div>
                    </div>
                    @endif

                    @if($navision -> opis_pretrazivanja <>"")
                    <div class="row">
                        <div class="col">
                            <small class="text-muted">Opis pretraživanja: {{ $navision -> opis_pretrazivanja }}</small>
                        </div>
                    </div>
                    @endif

                    @if($navision -> opis_pretrazivanja_1 <>"")
                    <div class="row">
                        <div class="col">
                            <small class="text-muted">Opis pretraživanja: {{ $navision -> opis_pretrazivanja_1 }}</small>
                        </div>
                    </div>
                    @endif

                    @if($navision -> opis_pretrazivanja_2 <>"")
                    <div class="row">
                        <div class="col">
                            <small class="text-muted">Opis pretraživanja: {{ $navision -> opis_pretrazivanja_2 }}</small>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <small class="text-muted">Količina na narudžbenici: {{ $navision -> kol_na_narudzbenici }}</small>
                        </div>
                    </div>
                @if(!$loop->last)
                    <hr />
                @endif
            @endforeach
        </div>
    </div>
        <div class="card-footer">
            <div class="text-right">
                <strong>Ukupno: {{ count($navisions)}}</strong>
            </div>
    </div>
  </div>
@endif


</div>
@endsection



