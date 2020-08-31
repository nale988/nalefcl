@extends('layouts.app')

@section('content')
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
                    <label for="amount">Količina</label>
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
                <input type="number" class="form-control form-control-sm" name="danger_level" id="danger_level" value="0">
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

            <div class="form-check mb-2">
                <input type="hidden" value="0" name="private_part" id="private_part">
                <input class="form-check-input" type="checkbox" name="private_part" id="private_part">
                <label class="form-check-label" for="private_part">
                    Privateno?
                </label>
            </div>

            <div class="card">
                <div class="card-header">Grupa rezervnih dijelova?</div>
                <div class="card-body">
                    @foreach($sparepartgroups as $sparepartgroup)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="" name="sparepartgroup-{{ $sparepartgroup->id }}" id="sparepartgroup-{{ $sparepartgroup->id }}">
                                <label class="form-check-label" for="sparepartgroup-{{ $sparepartgroup->id }}">
                                    <span class="mx-2">{{ $sparepartgroup -> description }}</span>
                                </label>
                            </div>
                    @endforeach
                </div>
            </div>

            <br />

            <div class="card">
                <div class="card-header">Prikači dokument</div>
                <div class="card-body">
                    <input id="file" type="file" name="file">
                </div>
            </div>

            <br />
            <div class="card card-header"><button class="btn btn-primary float-right" type="submit">Sačuvaj</button></div>
            <br />

            <div class="accordion" id="accordionPositions">
            @foreach($positions as $positiongrouptitle => $positiongroup)
                <div class="card">


                    <div class="card-header" id="heading{{ preg_replace('/[^a-z0-9.]+/i', '-', $positiongrouptitle) }}heading">
                        @if($loop->first)
                        <a class="btn btn-block" type="button" data-toggle="collapse" data-target="#c{{ preg_replace('/[^a-z0-9.]+/i', '-', $positiongrouptitle) }}" aria-expanded="true" aria-controls="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $positiongrouptitle) }}">
                        @else
                        <a class="btn btn-block collapsed" type="button" data-toggle="collapse" data-target="#c{{ preg_replace('/[^a-z0-9.]+/i', '-', $positiongrouptitle) }}" aria-expanded="true" aria-controls="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $positiongrouptitle) }}">
                        @endif
                            <strong>{{ $positiongrouptitle }}</strong>
                        </a>
                    </div>

                    @if($loop->first)
                    <div id="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $positiongrouptitle) }}" class="collapse show" aria-labelledby="heading{{ preg_replace('/[^a-z0-9.]+/i', '-', $positiongrouptitle) }}heading" data-parent="#accordionPositions">
                    @else
                    <div id="c{{ preg_replace('/[^a-z0-9.]+/i', '-', $positiongrouptitle) }}" class="collapse" aria-labelledby="heading{{ preg_replace('/[^a-z0-9.]+/i', '-', $positiongrouptitle) }}heading" data-parent="#accordionPositions">
                    @endif
                        <div class="card-body">
                        {{-- <button class="btn btn-primary float-right" type="submit">Sačuvaj</button> --}}
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    @foreach($positiongroup->sortBy('position') as $position)
                                    <tr>
                                        <td scope="row" class="text-nowrap" style="width: 60px;">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="" name="checkbox-{{ $position->id }}" id="checkbox-{{ $position->id }}">
                                                <label class="form-check-label" for="checkbox-{{ $position->id }}">
                                                    <strong>{{ $position -> position }}</strong>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">{{ $position -> name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <br />
            {{-- <button class="btn btn-primary" type="submit">Sačuvaj</button> --}}
        </form>
    </div>
</div>
@endsection
