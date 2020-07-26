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


<div class= "col-12">
    <div class="card">
        <div class="card-header">
            Novi rezervni dio
        </div>
        <div class="card-body">

        <form action="{{ route('spareparts.store') }}" method="POST" >
        @csrf
            <div class="form-group mb-2">
                <label for="storage_number">Skladišni broj</label>
                <input type="text" class="form-control form-control-sm" name="storage_number" id="storage_number" placeholder="Skladišni broj (uključiti i 0 ako time počinje u Navisionu)">
            </div>

            <div class="form-group mb-2">
                <label for="description">Opis</label>
                <input type="text" class="form-control form-control-sm" name="description" id="description" placeholder="Opis rezervnog dijela">
            </div>

            <div class="form-group mb-2">
                <label for="catalogue_number">Kataloški broj</label>
                <input type="text" class="form-control form-control-sm" name="catalogue_number" id="catalogue_number" placeholder="Kataloški broj">
            </div>

            <div class="form-group mb-2">
                <label for="info">Info</label>
                <input type="text" class="form-control form-control-sm" name="info" id="info" placeholder="Dodatne informacije (broj crteža, detalji i sl.)">
            </div>

            <div class="form-group mb-2">
                <label for="drawing_position">Pozicija na crtežu</label>
                <input type="text" class="form-control form-control-sm" name="drawing_position" id="drawing_position" placeholder="Pozicija na crtežu liste rezervnih dijelova">
            </div>

            <div class="form-group mb-2">
                <label for="danger_level">Kritična zaliha</label>
                <input type="number" class="form-control" name="danger_level" id="danger_level" placeholder="Iznos kritične zalihe u magacinu, za upozorenje za narudžbu">
            </div>

            <div class="form-group mb-2">
                <label for="spareparttype">Vrsta rezervnog dijela</label>
                <select id="spareparttype" name="spareparttype" class="form-control form-control-sm">
                    @foreach($spareparttypes as $spareparttype)
                        <option value="{{ $spareparttype -> id }}"> {{ $spareparttype -> description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" value="" name="critical_part" id="critical_part">
                <label class="form-check-label" for="critical_part">
                    Kritični dio?
                </label>
            </div>

            <br /><br />


            <div class="row">
                <div class= "col-12">
                    <div class="card">
                        <div class="card-header">
                            Pripada pozicijama:
                        </div>

                        <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach($positions as $title => $position)
                                    @if ($loop -> first)
                                        <a class="nav-link active text-center" id="v-pills-{{ $title }}-tab" data-toggle="pill" href="#v-pills-{{ $title }}" role="tab" aria-controls="v-pills-{{ $title }}" aria-selected="true">{{ $title }}</a>
                                    @else
                                        <a class="nav-link text-center" id="v-pills-{{ $title }}-tab" data-toggle="pill" href="#v-pills-{{ $title }}" role="tab" aria-controls="v-pills-{{ $title }}" aria-selected="false">{{ $title }}</a>
                                    @endif
                                @endforeach
                                </div>
                            </div>

                            <div class="col-1">&nbsp;</div>

                            <div class="col-10">
                                <div class="tab-content" id="v-pills-tabContent">
                                <br /><br />
                                @foreach($positions as $title => $positiongroup)
                                    @if($loop -> first)
                                        <div class="tab-pane fade show active" id="v-pills-{{ $title }}" role="tabpanel" aria-labelledby="v-pills-{{ $title }}-tab">
                                    @else
                                        <div class="tab-pane fade" id="v-pills-{{ $title }}" role="tabpanel" aria-labelledby="v-pills-{{ $title }}-tab">
                                    @endif
                                    @foreach($positiongroup->sortBy('position') as $position)
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" value="" name="checkbox-{{ $position->id }}" id="checkbox-{{ $position->id }}">
                                                    <label class="form-check-label" for="checkbox-{{ $position->id }}">
                                                        &nbsp;
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <span>{{ $position -> position }}</span>
                                            </div>

                                            <div class="col-4">
                                                <span class="text-muted text-truncate">{{ $position -> name }}</span>
                                            </div>

                                            <div class="col-5">
                                                <span class="text-muted text-truncate">{{ $position -> manufacturer }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div> <!-- ROW -->

                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-muted">
                <button class="btn btn-primary" type="submit">Sačuvaj</button>
            </div>
        </form>
    </div>
</div>
</div>


</div>
@endsection