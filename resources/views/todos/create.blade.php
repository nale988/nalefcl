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

<br />
<div class="table-responsive">
    <table class="table table-sm">
        <caption>Spisak svih stavki...</caption>
        <thead>
            <tr>
                <th>Opis</th>
                <th class="text-center" style="width: 220px">Mogućnosti</th>
                <th class="text-center">Datum</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todos as $todo)
            @if($todo -> urgent)
                <tr class="table-primary">
            @else
                <tr>
            @endif
                @if($todo -> done)
                    <td class="text-nowrap">
                        <del>{{ $todo -> description }}</del>
                    </td>
                    <td class="text-right" style="width: 220px">
                        <span class="text-muted">
                            <small>Aktiviraj:
                                <a href="{{ route('todos.reactivate', [$todo -> id, 7])}}" style="text-decoration:none;" title="Za 7 dana">7</a>&nbsp;/&nbsp;
                                <a href="{{ route('todos.reactivate', [$todo -> id, 14])}}" style="text-decoration:none;" title="Za 14 dana">14</a>&nbsp;/&nbsp;
                                <a href="{{ route('todos.reactivate', [$todo -> id, 21])}}" style="text-decoration:none;" title="Za 21 dana">21</a>&nbsp;/&nbsp;
                                <a href="{{ route('todos.reactivate', [$todo -> id, 30])}}" style="text-decoration:none;" title="Za 30 dana">30</a>&nbsp;/&nbsp;
                                <a href="{{ route('todos.reactivate', [$todo -> id, 60])}}" style="text-decoration:none;" title="Za 60 dana">60</a>
                            </small>
                        </span>
                    </td>
                @else
                    <td class="text-nowrap">
                        <a href="{{ route('todos.finish', $todo -> id)}}" title="Potvrdi napomenu.">
                            @include('layouts.buttons.btnnewtodo', ['color' => 'currentColor'])
                        </a>
                        {{ $todo -> description }}
                    </td>
                    <td class="text-right" style="width: 220px">
                        <span class="text-muted">
                            <small>
                                <a href="{{ route('todos.changetype', $todo -> id)}}" title="Promijeni vrstu (bitno/ostalo)">
                                    @include('layouts.buttons.btnworkorder', ['color' => 'currentColor'])
                                </a>
                                &nbsp;&nbsp;Aktiviraj:
                                <a href="{{ route('todos.reactivate', [$todo -> id, 7])}}" style="text-decoration:none;" title="Za 7 dana">7</a>&nbsp;/&nbsp;
                                <a href="{{ route('todos.reactivate', [$todo -> id, 14])}}" style="text-decoration:none;" title="Za 14 dana">14</a>&nbsp;/&nbsp;
                                <a href="{{ route('todos.reactivate', [$todo -> id, 21])}}" style="text-decoration:none;" title="Za 21 dana">21</a>&nbsp;/&nbsp;
                                <a href="{{ route('todos.reactivate', [$todo -> id, 30])}}" style="text-decoration:none;" title="Za 30 dana">30</a>&nbsp;/&nbsp;
                                <a href="{{ route('todos.reactivate', [$todo -> id, 60])}}" style="text-decoration:none;" title="Za 60 dana">60</a>
                            </small>
                        </span>
                    </td>
                @endif
                <td class="text-nowrap text-center">{{ date('d. m. y.', strtotime($todo -> date)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div aria-label="Pagination" class="pagination pagination-sm justify-content-center">{!! $todos->render() !!}</div>
@endsection
