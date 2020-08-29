
@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-dark text-white">
        <div class="float-left">Pregled rezervnog dijela</div>
        <div class="float-right">
            @if($user -> id == $sparepart -> user_id)
            <a href="{{ route('spareparts.edit', $sparepart -> id)}}" class="text-white" title="Uredi rezervni dio">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg>
            </a>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless table-striped table-sm">
                <tbody>
                    <tr>
                        <td scope="row" style="width: 140px;">Skladišni broj:</td>
                        <td><strong>{{ $sparepart -> storage_number }}</strong></td>
                    </tr>
                    <tr>
                        <td scope="row" style="width: 140px;">Opis:</td>
                        <td><strong>{{ $sparepart -> description }}</strong></td>
                    </tr>
                    <tr>
                        <td scope="row" style="width: 140px;">Kataloški broj:</td>
                        <td><strong>{{ $sparepart -> catalogue_number }}</strong></td>
                    </tr>
                    <tr>
                        <td scope="row" style="width: 140px;" class="text-nowrap">Info:</td>
                        <td class="text-nowrap"><strong>{{ $sparepart -> info }}</strong></td>
                    </tr>
                    <tr>
                        <td scope="row" style="width: 140px;">Broj narudžbe:</td>
                        <td><strong>{{ $sparepart -> order_number }}</strong></td>
                    </tr>
                    @if(count($sparepartgroup)>0)
                        @foreach($sparepartgroup as $group)
                            <tr>
                                <td scope="row" style="width: 140px;">Grupa:</td>
                                <td><strong>{{ $group -> description }}</strong></td>
                            </tr>
                        @endforeach
                    @endif

                    @if(count($positions)>0)
                    @foreach($positions as $position)
                        <tr>
                            <td scope="row" style="width: 140px;">Grupa:</td>
                            <td>
                                <strong>
                                    <a href="{{ route('positions.show', $position -> id)}}">
                                        {{ $position -> position }} - {{ $position -> name }}
                                    </a>
                                </strong>
                            </td>
                        </tr>
                    @endforeach
                @endif
                    <tr>
                        <td scope="row" style="width: 140px;">Pozicija:</td>
                        <td><strong>{{ $sparepart -> position }}</strong></td>
                    </tr>
                    <tr>
                        <td scope="row" style="width: 140px;">Jedinica mjere:</td>
                        <td><strong>{{ $sparepart -> unit }}</strong></td>
                    </tr>
                    <tr>
                        <td scope="row" style="width: 140px;">Signalni nivo:</td>
                        <td><strong>{{ $sparepart -> danger_level }}</strong></td>
                    </tr>
                    <tr>
                        <td scope="row" style="width: 140px;">Kritični dio:</td>
                        <td><strong>
                        @if($sparepart -> critical_part)
                        DA
                        @else
                        NE
                        @endif
                        </strong></td>
                    </tr>
                    @if(count($sparepartfile)>0)
                    @foreach($sparepartfile as $file)
                    <tr>
                        <td scope="row" style="width: 140px">Dokument:</td>
                        <td>
                            <a href="{{ URL::asset($file -> url) }}" >{{ $file -> filename }}</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    <tr>
                        <td scope="row" style="width: 140px;">Kreirao:</td>
                        <td>
                            <strong>
                                @if(is_null($createdby))
                                <small>(nema korisnika)</small>
                                @else
                                {{ $user -> name}}
                                @endif
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" style="width: 140px;">Datum kreiranja:</td>
                        <td>
                            <strong>
                                @if(is_null($sparepart -> created_at))
                                -
                                @else
                                {{ $sparepart -> updated_at->format('d. m. Y.') }} u {{ $sparepart -> created_at -> format('H:i') }}
                                @endif
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" style="width: 140px;">Datum izmjene:</td>
                        <td>
                            <strong>
                                @if(is_null($sparepart -> updated_at))
                                -
                                @else
                                {{ $sparepart -> updated_at->format('d. m. Y.') }} u {{ $sparepart -> updated_at -> format('H:i') }}
                                @endif
                            </strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

