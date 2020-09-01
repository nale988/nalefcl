@extends('layouts.app')
@section('content')

@include('layouts.snippets.header', ['title' => 'Spisak svih stavki', 'subtitle' => ''])

<div class="table-responsive">
    <table class="table table-sm">
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
                                <a href="{{ route('todos.reactivate', [$todo -> id, 60])}}" style="text-decoration:none;" title="Za 60 dana">60</a>&nbsp;dana
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
                                <a href="{{ route('todos.reactivate', [$todo -> id, 60])}}" style="text-decoration:none;" title="Za 60 dana">60</a>&nbsp;dana
                            </small>
                        </span>
                    </td>
                @endif
                <td class="text-nowrap text-center">{{ date('d. m. Y.', strtotime($todo -> date)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div aria-label="Pagination" class="pagination pagination-sm justify-content-center">{!! $todos->render() !!}</div>
@endsection
