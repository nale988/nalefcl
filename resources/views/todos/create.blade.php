@extends('layouts.app')

@section('content')
<form action="{{ route('todos.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group mb-2">
                <label for="date">Datum</label>
                <input type="date" class="form-control form-control-sm" name="date" id="date" value="{{ now()->modify('+2 day')->format('Y-m-d') }}">
            </div>
        </div>
        <div class="col-sm-10">
                <div class="form-group mb-2">
                    <label for="description">Opis</label>
                    <input type="text" class="form-control form-control-sm" name="description" id="description">
                </div>
                <div class="form-check">
                    <input type="hidden" value="0" name="urgent" id="urgent">
                    <input class="form-check-input" type="checkbox" name="urgent" id="urgent">
                    <label class="form-check-label" for="urgent">
                        Hitno!
                    </label>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <button class="btn btn-primary btn-block" type="submit">Sačuvaj</button>
        </div>
    </div>
</form>
@endsection
