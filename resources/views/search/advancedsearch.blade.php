@extends('layouts.app')

@section('content')

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
                        <label for="searchvalue">Traženi pojam</label>
                        <input type="text" class="form-control form-control-sm" name="searchvalue" id="searchvalue" >
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="search-positions" id="search-positions">
                        <label class="form-check-label" for="search-positions">
                            Traži u pozicijama
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="search-spareparts" id="search-spareparts">
                        <label class="form-check-label" for="search-spareparts">
                            Traži u rezervnim dijelovima
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="search-spareparttypes" id="search-spareparttypes">
                        <label class="form-check-label" for="search-spareparttypes">
                            Traži u vrsti rezervnih dijelova
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="search-files" id="search-files">
                        <label class="form-check-label" for="search-files">
                            Traži u dokumentima
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="search-revisions" id="search-revisions">
                        <label class="form-check-label" for="search-revisions">
                            Traži u napomenama
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="search-navision" id="search-navision">
                        <label class="form-check-label" for="search-navision">
                            Traži u Navisionu
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

@endsection
