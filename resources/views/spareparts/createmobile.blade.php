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

        <form action="{{ route('spareparts.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
            <div class="form-group mb-2">
                <label for="storage_number">Skladišni broj</label>
                <input type="text" class="form-control form-control-sm" name="storage_number" id="storage_number" placeholder="Skladišni broj (uključiti i 0 ako time počinje u Navisionu)">
            </div>

            <div class="form-group mb-2">
                <label for="description">Opis</label>
                <input type="text" class="form-control form-control-sm" name="description" id="description">
            </div>

            <div class="form-group mb-2">
                <label for="catalogue_number">Kataloški broj</label>
                <input type="text" class="form-control form-control-sm" name="catalogue_number" id="catalogue_number">
            </div>

            <div class="form-group mb-2">
                <label for="info">Grupa rezervnih dijelova</label>
                <input type="text" class="form-control form-control-sm" name="spare_part_group" id="spare_part_group" placeholder="... reduktor // pogonska stanica // grajfer ...">
            </div>

            <div class="form-group mb-2">
                <label for="info">Info</label>
                <input type="text" class="form-control form-control-sm" name="info" id="info" placeholder="Dodatne informacije (broj crteža, detalji i sl.)">
            </div>

            <div class="form-group mb-2">
                <label for="drawing_position">Pozicija na crtežu</label>
                <input type="text" class="form-control form-control-sm" name="drawing_position" id="drawing_position" placeholder="Pozicija na crtežu liste rezervnih dijelova">
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group mb-2">
                    <label for="drawing_position">Količina</label>
                    <input type="number" step=".01" class="form-control form-control-sm" name="amount" id="amount" value="1">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group mb-2">
                    <label for="drawing_position">Jedinica mjere</label>
                    <input type="text" class="form-control form-control-sm" name="unit" id="unit" placeholder="kom // m // kg // L // set...">
                    </div>
                </div>
            </div>

            <div class="form-group mb-2">
                <label for="danger_level">Signalna zaliha</label>
                <input type="number" class="form-control" name="danger_level" id="danger_level" value="0">
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
                <input type="hidden" value="0" name="critical_part" id="critical_part">
                <input class="form-check-input" type="checkbox" name="critical_part" id="critical_part">
                <label class="form-check-label" for="critical_part">
                    Kritični dio?
                </label>
            </div>

            <br />

            <div class="card">
                <div class="card-header">Prikači dokument</div>
                <div class="card-body">
                    <input id="file" type="file" name="file">
                </div>
            </div>

            <br /><br />

            <div class="row">
                <div class= "col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    Pripada pozicijama:
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-primary btn-block" type="submit">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-key" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-truncate">
                                    @foreach($positions as $title => $positiongroup)
                                    @if(!$loop->first)
                                        <br /><br />
                                    @endif
                                        <div class="row">
                                            <div class="col">
                                            <h5><strong>&nbsp;{{ $title }} - {{ $positiongroup -> first() -> unit -> description }}</strong></h5>
                                            <hr />
                                            </div>
                                        </div>

                                        @foreach($positiongroup->sortBy('position') as $position)
                                            <div class="row">
                                                <div class="col">

                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" value="" name="checkbox-{{ $position->id }}" id="checkbox-{{ $position->id }}">
                                                        <label class="form-check-label" for="checkbox-{{ $position->id }}">
                                                            <strong>{{ $position -> position }}</strong>
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <span class="text-truncate">{{ $position -> name }}</span>
                                                </div>
                                            </div>
                                            <br />
                                        @endforeach
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<br />
<br />
</div>
@endsection
