@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col">
    <div class="card bg-light mb-3">
        <div class="card-header font-weight-bold">
            Dodaj u narudžbe rezervni dio {{ $sparepart -> storage_number }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">Pozicija:</div>
                <div class="col"><a href="{{ route('positions.show', $position -> id)}}">{{ $position -> position }} - {{ $position -> name }}</a></div>
            </div>
            <hr />
            <div class="row">
                <div class="col-2">{{ $sparepart -> storage_number }}</a></div>
                <div class="col-5">{{ $sparepart -> description }}</a></div>
                <div class="col-5">{{ $sparepart -> catalogue_number }}</a></div>
            </div>
            <hr />
            <form action="{{ route('sparepartorders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="position_id" value="{{ $position -> id }}">
                <input type="hidden" name="spare_part_id" value="{{ $sparepart -> id }}">

                <div class="form-group row">
                    <label for="amount" class="col-sm-2 col-form-label">Tražena količina</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="amount" value="{{ $amount }}">
                    </div>
                    <label class="col-sm-2 col-form-label">{{$sparepart -> unit}}</label>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-2 col-form-label">Naručiti do:</label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" name="date" value="{{ now()->modify('+15 day')->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="note">Napomena</label>
                    <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Sačuvaj</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
