@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header border-dark bg-dark text-white">
        <strong>Pretraga u Navisionu (baza: {{ date('d. m. Y.', strtotime($info -> navision)) }})</strong>
    </div>
    <div class="card-body">
        <!-- TODO: Make mobile friendly -->
        @foreach($searchresults as $navision)
            <div class="row">
                <div class="col">
                    <strong>{{ $navision -> br}}</strong>
                </div>
                <div class="col-4 text-right">
                    {{ $navision -> zalihe }} {{ $navision -> jm_za_nabavu }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <strong>{{ $navision -> opis }}</strong>
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
            @if($navision -> br_police <> "")
            <div class="row">
                <div class="col">
                    <small class="text-muted">Broj police: {{ $navision -> br_police }}</small>
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
    <div class="card-footer border-dark bg-dark text-white">
        Rezultata: {{ count($searchresults) }}
    </div>
</div>

@endsection
