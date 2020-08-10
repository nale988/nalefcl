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
            <div class="row">
                <div class="col">
                    Uredi rezervni dio
                </div>
                <div class="col-2 text-right">
                    <button type="button" class="close" data-toggle="modal" data-target="#deleteModal">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteSparePart" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteSparePart">Obriši</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Jeste li sigurni da želite obrisati rezervni dio?
                      </div>
                      <div class="modal-footer">
                          <form action="{{ route('spareparts.destroy', $sparepart -> id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="sparepart_id" value="{{ $sparepart -> id }}" />
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                                <button type="submit" class="btn btn-danger">Obriši</button>
                          </form>
                      </div>
                    </div>
                  </div>
            </div>
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
                    @if(!empty($selected_positions -> first() -> amount))
                        <input type="number" step=".01" class="form-control form-control-sm" name="amount" id="amount" value="{{ $selected_positions -> first() -> amount}}">
                    @else
                        <input type="number" step=".01" class="form-control form-control-sm" name="amount" id="amount" value="1">
                    @endif
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

            <div class="card">
                <div class="card-header">
                    Grupe rezervnih dijelova
                </div>
                <div class="card-body">
                    @foreach($sparepartgroups as $sparepartgroup)
                        <div class="row">
                            <div class="col-1">
                                <div class="form-check mb-2">
                                    @php
                                        $added = 0;
                                    @endphp

                                    @foreach($selected_sparepartgroups as $selected)
                                        @if(($selected -> spare_part_group_id) === ($sparepartgroup -> id))
                                            <input checked class="form-check-input" type="checkbox" name="sparepartgroup-{{ $sparepartgroup->id }}" id="sparepartgroup-{{ $sparepartgroup->id }}" >
                                            @php
                                                $added = 1
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if($added == 0)
                                        <input class="form-check-input" type="checkbox" name="sparepartgroup-{{ $sparepartgroup->id }}" id="sparepartgroup-{{ $sparepartgroup->id }}">
                                    @endif
                                    <label class="form-check-label" for="sparepartgroup-{{ $sparepartgroup->id }}">&nbsp;</label>
                                </div>
                            </div>
                            <div class="col">
                                <span>{{ $sparepartgroup -> description }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <br />
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
