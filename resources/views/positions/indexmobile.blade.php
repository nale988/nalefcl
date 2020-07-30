@extends('layouts.app')

@section('content')
<div class="container">

<div class="card" >
  <div class="card-header">
    Spisak svih pozicija
  </div>
  <ul class="list-group list-group-flush">
    @foreach($positions as $position)
        <li class="list-group-item">
        <a href="{{ route('positions.show', $position->id) }}" style="color: #000000; text-decoration: none;" >
            <div class="row">
                <div class="col-12">
                    <strong>{{ $position -> position }}</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    &nbsp;&nbsp;&nbsp;{{ $position -> name }}
                </div>
            </div>
        </a>
        </li>
    @endforeach
  </ul>
  <br />
  <div aria-label="Pagination" class="pagination justify-content-center">{!! $positions->render() !!}</div>
</div>

</div>
@endsection
