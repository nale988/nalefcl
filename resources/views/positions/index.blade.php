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
        <!-- style="overflow: hidden; white-space:nowrap; text-overflow: ellipsis;"> -->
        <a href="{{ route('positions.show', $position->id) }}" style="color: #000000; text-decoration: none;" >
            <div class="row" onMouseOver="this.style.backgroundColor='#EEEEEE'" onMouseOut="this.style.backgroundColor='#F8F9FA'">
            <div class="col-2">
                <strong>{{ $position -> position }}</strong>
            </div>
            <div class="col">
                {{ $position -> name }} 
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