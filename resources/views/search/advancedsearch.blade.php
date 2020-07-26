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

<div class="row">
    <div class="col" id="advancedsearch">
        <div class="card bg-light mb-3">
            <div class="card-header font-weight-bold">
                Napredna pretraga
            </div>
            <form action="{{ route('advancedsearchresults') }}" method="GET" >
                @csrf
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="description">Traženi pojam</label>
                        <input type="text" class="form-control form-control-sm" name="description" id="description" >
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" name="search-positions" id="search-positions">
                        <label class="form-check-label" for="search-positions">
                            Traži u pozicijama
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" name="search-spareparts" id="search-spareparts">
                        <label class="form-check-label" for="search-spareparts">
                            Traži u rezervnim dijelovima
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" name="search-files" id="search-files">
                        <label class="form-check-label" for="search-files">
                            Traži u dokumentima
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="" name="search-revisions" id="search-revisions">
                        <label class="form-check-label" for="search-revisions">
                            Traži u napomenama
                        </label>
                    </div>
                </div>

                <div class="card-footer text-muted">
                    <button class="btn btn-primary" type="submit">Traži</button>
                </div>
            </form>
        </div>
    </div>
</div>



</div>
@endsection
