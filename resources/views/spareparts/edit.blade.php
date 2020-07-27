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
            Uredi rezervni dio
        </div>
        <div class="card-body">

        <form action="{{ route('spareparts.update', $sparepart -> id) }}" method="POST" enctype="multipart/form-data" >
        @method('PUT')
        @csrf
            <div class="form-group mb-2">
                <label for="storage_number">Skladišni broj</label>
                <input type="text" class="form-control form-control-sm" name="storage_number" id="storage_number" value="{{ $sparepart -> storage_number }}">
            </div>

            <div class="form-group mb-2">
                <label for="description">Opis</label>
                <input type="text" class="form-control form-control-sm" name="description" id="description" value="{{ $sparepart -> description }}">
            </div>

            <div class="form-group mb-2">
                <label for="catalogue_number">Kataloški broj</label>
                <input type="text" class="form-control form-control-sm" name="catalogue_number" id="catalogue_number" value="{{ $sparepart -> catalogue_number }}">
            </div>

            <div class="form-group mb-2">
                <label for="info">Grupa rezervnih dijelova</label>
                <input type="text" class="form-control form-control-sm" name="spare_part_group" id="spare_part_group" value="{{ $sparepart -> spare_part_group }}">
            </div>

            <div class="form-group mb-2">
                <label for="info">Info</label>
                <input type="text" class="form-control form-control-sm" name="info" id="info" value="{{ $sparepart -> info }}">
            </div>

            <div class="form-group mb-2">
                <label for="drawing_position">Pozicija na crtežu</label>
                <input type="text" class="form-control form-control-sm" name="drawing_position" id="drawing_position" value="{{ $sparepart -> position }}">
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group mb-2">
                    <label for="drawing_position">Količina</label>
                    <input type="number" step=".01" class="form-control form-control-sm" name="amount" id="amount" value="{{ $selected_positions -> first() -> amount}}">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group mb-2">
                    <label for="drawing_position">Jedinica mjere</label>
                    <input type="text" class="form-control form-control-sm" name="unit" id="unit" value="{{ $sparepart -> unit }}">
                    </div>
                </div>
            </div>

            <div class="form-group mb-2">
                <label for="danger_level">Signalna zaliha</label>
                <input type="number" class="form-control form-control-sm" name="danger_level" id="danger_level" value="{{ $sparepart -> danger_level }}">
            </div>

            <div class="form-group mb-2">
                <label for="spareparttype">Vrsta rezervnog dijela</label>
                <select id="spareparttype" name="spareparttype" class="form-control form-control-sm">
                    @foreach($spareparttypes as $spareparttype)
                        @if($sparepart -> spare_part_type_id == $spareparttype -> id)
                            <option value="{{ $spareparttype -> id }}" selected> {{ $spareparttype -> description }}</option>
                        @else
                            <option value="{{ $spareparttype -> id }}"> {{ $spareparttype -> description }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-check mb-2">
                <input type="hidden" value="0" name="critical_part" id="critical_part">
                <input class="form-check-input" type="checkbox" name="critical_part" id="critical_part" {{ $sparepart -> critical_part ? 'checked':'' }}>
                <label class="form-check-label" for="critical_part">
                    Kritični dio?
                </label>
            </div>

            <br />

            @if(count($file)>0)
                @foreach($file as $files)
                <div class="card">
                    <div class="card-header">Prikačeni dokumenti</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ URL::asset($files -> url) }}" >{{ $files -> filename }}</a>
                            </div>
                            <div class="col-2">
                                {{ number_format(round($files -> filesize/1024, 0), 0, '.', ' ') }}kB
                            </div>
                            <div class="col-1">
                                <a href="{{ route('removesparepartfile', $files -> id) }}" class="btn btn-danger">Ukloni</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="card">
                    <div class="card-header">Prikači dokument</div>
                    <div class="card-body">
                        <input id="file" type="file" name="file">
                    </div>
                </div>
            @endif
            <br /><br />

            <div class="row">
                <div class= "col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    Pripada pozicijama:
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary btn-block" type="submit">Sačuvaj</button>
                                </div>
                            </div>
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
                                                    @php
                                                        $added = 0;
                                                    @endphp

                                                    @foreach($selected_positions as $selected)
                                                        @if(($selected -> position_id) === ($position -> id))
                                                            <input checked class="form-check-input" type="checkbox" name="checkbox-{{ $position->id }}" id="checkbox-{{ $position->id }}" >
                                                            @php
                                                                $added = 1
                                                            @endphp
                                                        @endif
                                                    @endforeach

                                                    @if($added == 0)
                                                        <input class="form-check-input" type="checkbox" name="checkbox-{{ $position->id }}" id="checkbox-{{ $position->id }}">
                                                    @endif
                                                    <label class="form-check-label" for="checkbox-{{ $position->id }}">&nbsp;</label>
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
            </div>
        </form>
    </div>
</div>
</div>

<br />
<br />
</div>
@endsection
