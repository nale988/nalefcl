@extends('layouts.app')

@section('content')

    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Opis</th>
                    <th>Datum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($todos as $todo)
                @if($todo -> urgent)
                    <tr class="table-alert">
                @else
                    <tr>
                @endif
                    @if($todo -> done)
                        <td  class="text-nowrap"><del>{{ $todo -> description }}</del></td>
                    @else
                        <td  class="text-nowrap">{{ $todo -> description }}</td>
                    @endif
                    <td  class="text-nowrap">{{ date('d. m. y.', strtotime($todo -> date)) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
