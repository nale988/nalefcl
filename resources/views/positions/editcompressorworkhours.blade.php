@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-dark text-white">Uredi podatke o radnim satima</div>
    <div class="card-body">
        <form class="m-2" method="post" action="{{ route('updateworkinghours') }}">
            @csrf
            <input type="hidden" value="{{ $workhours -> id }}" name="id" />
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <input type="text" name="total" class="form-control" value="{{ $workhours -> total }}" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                            <input type="text" name="loaded" class="form-control" value="{{ $workhours -> loaded }}" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                            <input type="text" name="starts" class="form-control" value="{{ $workhours -> starts }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <label for="description">Komentar:</label>
                        <textarea class="form-control" name="comment" rows="1">{{ $workhours -> comment }}</textarea>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="date">Datum mjerenja:</label>
                        <input type="date" name="date" class="form-control" value="{{ $workhours -> date}}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-dark btn-sm">Sačuvaj</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
