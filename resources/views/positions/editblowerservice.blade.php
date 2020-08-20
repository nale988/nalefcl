@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-dark text-white">Uredi podatke o servisu</div>
    <div class="card-body">
        <form class="m-2" method="post" action="{{ route('updateblowerservice') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $blowerservice -> id}}" />
            <div class="row">
                <div class="col-3">
                    <div class="form-check mb-2">
                        <input type="hidden" value="0" name="inspection" id="inspection">
                        <input class="form-check-input" type="checkbox" name="inspection" id="inspection" {{ $blowerservice -> inspection ? 'checked':'' }}>
                        <label class="form-check-label" for="inspection">
                            Pregled
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="hidden" value="0" name="filter" id="filter">
                        <input class="form-check-input" type="checkbox" name="filter" id="filter" {{ $blowerservice -> filter ? 'checked':'' }}>
                        <label class="form-check-label" for="filter">
                            Usisni filter
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="hidden" value="0" name="belt" id="belt">
                        <input class="form-check-input" type="checkbox" name="belt" id="belt" {{ $blowerservice -> belt ? 'checked':'' }}>
                        <label class="form-check-label" for="belt">
                            Remen
                        </label>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-check mb-2">
                        <input type="hidden" value="0" name="pulley" id="pulley">
                        <input class="form-check-input" type="checkbox" name="pulley" id="pulley" {{ $blowerservice -> pulley ? 'checked':'' }}>
                        <label class="form-check-label" for="pulley">
                            Remenica
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="hidden" value="0" name="oil" id="oil">
                        <input class="form-check-input" type="checkbox" name="oil" id="oil" {{ $blowerservice -> oil ? 'checked':'' }}>
                        <label class="form-check-label" for="oil">
                            Ulje
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="hidden" value="0" name="nonreturn_valve" id="nonreturn_valve">
                        <input class="form-check-input" type="checkbox" name="nonreturn_valve" id="nonreturn_valve" {{ $blowerservice -> nonreturn_valve ? 'checked':'' }}>
                        <label class="form-check-label" for="nonreturn_valve">
                            Nepovratni ventil
                        </label>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-check mb-2">
                        <input type="hidden" value="0" name="element_repair" id="element_repair">
                        <input class="form-check-input" type="checkbox" name="element_repair" id="element_repair" {{ $blowerservice -> element_repair ? 'checked':'' }}>
                        <label class="form-check-label" for="element_repair">
                            Remont elementa
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="hidden" value="0" name="element_replace" id="element_replace">
                        <input class="form-check-input" type="checkbox" name="element_replace" id="element_replace" {{ $blowerservice -> element_replace ? 'checked':'' }}>
                        <label class="form-check-label" for="element_replace">
                            Zamjena elementa
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="hidden" value="0" name="first_start" id="first_start">
                        <input class="form-check-input" type="checkbox" name="first_start" id="first_start" {{ $blowerservice -> first_start ? 'checked':'' }}>
                        <label class="form-check-label" for="first_start">
                            Puštanje u pogon
                        </label>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-check mb-2">
                        <input type="hidden" value="0" name="other" id="other">
                        <input class="form-check-input" type="checkbox" name="other" id="other"  {{ $blowerservice -> other ? 'checked':'' }}>
                        <label class="form-check-label" for="other">
                            Drugo
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="description">Komentar:</label>
                        <textarea class="form-control" name="comment" rows="2">{{ $blowerservice -> comment }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    @if(count($blowerservice -> files)>0)
                        <div class="row">
                            <div class="col text-truncate">
                                <a href="{{ URL::asset($blowerservice -> files ->first() -> url) }}">
                                    {{ $blowerservice -> files -> first() -> filename }}
                                </a>
                            </div>
                            <div class="col-2">
                                {{ number_format(round($blowerservice -> files ->first() -> filesize/1024, 0), 0, '.', ' ') }}kB
                            </div>
                            <div class="col-1">
                                <a href="{{ route('removeblowerservicefile', $blowerservice -> files ->first() -> id) }}" class="btn btn-danger btn-sm">Ukloni</a>
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <input id="file" type="file" name="file">
                        </div>
                    @endif
                </div>
                <div class="col">
                    <div class="form-inline float-right">
                    <input type="date" name="date" class="form-control" value="{{ $blowerservice -> date }}" />
                    <button type="submit" class="btn btn-dark btn-sm ml-2">Sačuvaj izmjenu</button>
                    </div>
                </div>
            </div>


        </form>
    </div>
</div>
@endsection
