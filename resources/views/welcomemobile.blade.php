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

@if(count($sparepartorders)>0)
<div class="row">
    <div class="col">
        <div class="card bg-light mb-3">
            <div class="card-header font-weight-bold">
                Pregled narudžbi
            </div>
            <div class="card-body">
                @foreach($sparepartorders as $sparepartorder)
                    <div class="row">
                        <div class="col text-truncate">
                            @if($today -> gt($sparepartorder -> date))
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-alarm" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 15A6 6 0 1 0 8 3a6 6 0 0 0 0 12zm0 1A7 7 0 1 0 8 2a7 7 0 0 0 0 14z"/>
                                    <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.053.224l-1.5 3a.5.5 0 1 1-.894-.448L7.5 8.882V5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
                                    <path fill-rule="evenodd" d="M11.646 14.146a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1-.708.708l-1-1a.5.5 0 0 1 0-.708zm-7.292 0a.5.5 0 0 0-.708 0l-1 1a.5.5 0 0 0 .708.708l1-1a.5.5 0 0 0 0-.708zM5.5.5A.5.5 0 0 1 6 0h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M7 1h2v2H7V1z"/>
                                </svg>
                                <strong>{{ date('d. m. Y', strtotime($sparepartorder -> date)) }}</strong>
                            @else
                                {{ date('d. m. Y', strtotime($sparepartorder -> date)) }}
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-truncate">
                            {{ $sparepartorder -> sparepart -> storage_number }} - {{ $sparepartorder -> sparepart -> description}}
                        </div>
                        <div class="col-4 text-right">
                            {{ $sparepartorder -> amount }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <a class="btn btn-primary" href="{{ route('positions.show', $sparepartorder -> position_id) }}" title="{{ $sparepartorder -> position -> position }} - {{ $sparepartorder -> position -> name}}" style="text-decoration: none;">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-share" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M11.724 3.947l-7 3.5-.448-.894 7-3.5.448.894zm-.448 9l-7-3.5.448-.894 7 3.5-.448.894z"/>
                                    <path fill-rule="evenodd" d="M13.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm0 10a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm-11-6.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                  </svg>
                            </a>

                            @if(($sparepartorder -> note) <> "")
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal-{{ $sparepartorder -> id }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-medical" fill="white" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                                    <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                                    <path fill-rule="evenodd" d="M7 4a.5.5 0 0 1 .5.5v.634l.549-.317a.5.5 0 1 1 .5.866L8 6l.549.317a.5.5 0 1 1-.5.866L7.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L6 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5A.5.5 0 0 1 7 4zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </a>
                                <div class="modal fade" id="modal-{{ $sparepartorder -> id }}" tabindex="-1" role="dialog" aria-labelledby="modal-{{ $sparepartorder -> id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Napomena za narudžbu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                {{ $sparepartorder -> note }} TEST
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <a class="btn btn-primary" href="{{ route('confirmorder', $sparepartorder -> id) }}" title="Potvrdi narudžbu">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                    <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 13.5 8a.5.5 0 0 1 1 0 6.5 6.5 0 1 1-3.25-5.63.5.5 0 1 1-.5.865A5.472 5.472 0 0 0 8 2.5z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <hr />
                    @endif
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col">
        <div class="card bg-light mb-3">
            <div class="card-header font-weight-bold">
                Moji posljednji nalozi
            </div>
            <div class="card-body">
                @foreach($myworkorders as $workorder)
                <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                <div class="row">
                    <div class="col-6 text-truncate" title="{{$workorder->number}}">{{ $workorder -> number }}</div>
                    <div class="col-6 text-muted text-right text-truncate">{{ date('d. m. Y.', strtotime($workorder -> date)) }}</div>
                </div>
                <div class="row">
                    <div class="col text-truncate" title="{{ $workorder -> content }}">{{ $workorder -> content }}</div>
                </div>
                </a>
                @if(!$loop->last)
                    <hr />
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card bg-light mb-3">
            <div class="card-header font-weight-bold">
                Posljednji nalozi
            </div>
            <div class="card-body">
                @foreach($myworkorders as $workorder)
                <a href="{{ route('workorder', $workorder -> id) }}" style="text-decoration: none; color: #000000;">
                <div class="row">
                    <div class="col-6 text-truncate" title="{{$workorder->number}}">{{ $workorder -> number }}</div>
                    <div class="col-6 text-muted text-right text-truncate">{{ $workorder -> owner }}</div>
                </div>
                <div class="row">
                    <div class="col text-truncate" title="{{ $workorder -> content }}">{{ $workorder -> content }}</div>
                </div>
                </a>
                @if(!$loop->last)
                    <hr />
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col">
        <div class="card bg-light mb-3">
            <div class="card-header font-weight-bold">
                Info
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        Navision:<br /> {{ date('d. m. Y.', strtotime($info -> navision))}}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Baza RN:<br /> {{ date('d. m. Y.', strtotime($base -> navision))}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div> <!-- CONTAINER -->
@endsection
