@extends('layouts.app')
@section('content')

@include('layouts.snippets.headerleft', ['title' => 'Otvori novi', 'subtitle' => 'radni nalog'])
<br />
<br />
<form action="{{ route('workorders.store') }}" method="POST">
<div class="row">
    <div class="form-group">
      <input type="text" name="workorder_number" id="workorder_number" class="form-control" placeholder="Broj radnog naloga" aria-describedby="workorder_number_help">
      <small id="workorder_number_help" class="text-muted">Help text</small>
    </div>

    <div class="form-group">
        <input type="text" name="position_unit" id="position_unit" class="form-control" value="{{ $position -> unit -> description }}" aria-describedby="position_unit_help" readonly>
        <small id="position_unit_help" class="text-muted">Pogon</small>
      </div>

    <div class="form-group">
        <input type="text" name="position_position" id="position_position" class="form-control" value="{{ $position -> position }}" aria-describedby="position_position_help" readonly>
        <small id="position_position_help" class="text-muted">Pozicija</small>
    </div>
</form>
@endsection
