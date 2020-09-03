@extends('layouts.app')
@section('content')

@include('layouts.snippets.headerleft', ['title'=>'Narudžbe', 'subtitle' => ''])

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead class="thead-inverse">
            <tr>
                <th>Datum</th>
                <th>Opis</th>
                <th class="text-center">Količina</th>
                <th>Pozicija</th>
                <th class="text-center">Potvrdi</th>
            </tr>
            </thead>
            <tbody>
                @foreach($sparepartorders as $sparepartorder)
                    @if($today -> gt($sparepartorder -> date))
                        <tr class="table-danger">
                    @else
                        <tr>
                    @endif
                        <td scope="row">{{ date('d. m. Y', strtotime($sparepartorder -> date)) }}</td>
                        <td class="text-nowrap">{{ $sparepartorder -> sparepart -> storage_number }} - {{ $sparepartorder -> sparepart -> description}}</td>
                        <td class="text-nowrap text-center">{{ $sparepartorder -> amount }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('positions.show', $sparepartorder -> position_id) }}" style="text-decoration: none;">
                                {{ $sparepartorder -> position -> position }} - {{ $sparepartorder -> position -> name}}
                            </a>

                            @if(($sparepartorder -> note) <> "")
                                <a href="#" data-toggle="modal" data-target="#modal-{{ $sparepartorder -> id }}">
                                    @include('layouts.buttons.btnreadmore', ['color' => 'currentColor'])
                                </a>

                                <div class="modal fade" id="modal-{{ $sparepartorder -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Napomena za narudžbu</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        {{ $sparepartorder -> note }}
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('confirmorder', $sparepartorder -> id) }}" title="Potvrdi narudžbu">
                                @include('layouts.buttons.btnconfirm', ['color' => 'currentColor'])
                            </a>
                        </td>
                        </tr>
                @endforeach
            </tbody>
    </table>
</div>
@endsection
