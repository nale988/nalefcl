@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col">
    <div class="card bg-light mb-3">
        <div class="card-header font-weight-bold">
            Pregled narudžbi
        </div>
        <div class="card-body">
            @foreach($sparepartorders as $sparepartorder)
            <div class="row">
                <div class="col-12 text-truncate">
                    @if($today -> gt($sparepartorder -> date))
                        <strong>{{ date('d. m. Y', strtotime($sparepartorder -> date)) }}</strong>
                        &nbsp;&nbsp;&nbsp;
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-alarm" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15A6 6 0 1 0 8 3a6 6 0 0 0 0 12zm0 1A7 7 0 1 0 8 2a7 7 0 0 0 0 14z"/>
                                <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.053.224l-1.5 3a.5.5 0 1 1-.894-.448L7.5 8.882V5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
                                <path fill-rule="evenodd" d="M11.646 14.146a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1-.708.708l-1-1a.5.5 0 0 1 0-.708zm-7.292 0a.5.5 0 0 0-.708 0l-1 1a.5.5 0 0 0 .708.708l1-1a.5.5 0 0 0 0-.708zM5.5.5A.5.5 0 0 1 6 0h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                <path d="M7 1h2v2H7V1z"/>
                            </svg>
                        @else
                            {{ date('d. m. Y', strtotime($sparepartorder -> date)) }}
                        @endif
                </div>
            </div>

            <div class="row">
                <div class="col-10 text-truncate">
                    {{ $sparepartorder -> sparepart -> storage_number }} - {{ $sparepartorder -> sparepart -> description}}
                </div>

                <div class="col-2 text-truncate">
                    {{ $sparepartorder -> amount }}
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-truncate">
                    <a href="{{ route('positions.show', $sparepartorder -> position_id) }}" style="text-decoration: none;">
                        {{ $sparepartorder -> position -> position }} - {{ $sparepartorder -> position -> name}}
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-3">
                    <a href="{{ route('confirmorder', $sparepartorder -> id) }}" title="Potvrdi narudžbu" class="btn btn-primary">
                        Potvrdi
                    </a>
                </div>
                <div class="col-6">
                    @if(($sparepartorder -> note) <> "")
                        <a href="#" data-toggle="modal" data-target="#modal-{{ $sparepartorder -> id }}" class="btn btn-primary">
                            Napomena
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
                                <div class="modal-body text-justify">
                                  {{ $sparepartorder -> note }}
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    @endif
                </div>
            </div>
            <hr />
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection
