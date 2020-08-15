@extends('layouts.app')

@section('content')
@if(count($items)>0)
    <div class="row">
        <table class="table table-hover table-sm">
            <caption>Pregled unosa</caption>
            <thead>
                <tr>
                    <th scope="col">Početak</th>
                    <th scope="col">Kraj</th>
                    <th scope="col">Opis</th>
                    <th scope="col">Radni nalog</th>
                    <th scope="col">Sati rada</th>
                    <th scope="col">Prekovremeni sati</th>
                    <th scope="col">Opcije</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $date => $values)
                    <tr>
                        <th scope="row" colspan="7">{{ date('d. m. Y', strtotime($date)) }}</th>
                    </tr>
                    @foreach($values as $item)
                    @if($item -> overtime == 1)
                        <tr class="table-danger">
                    @else
                        <tr>
                    @endif
                        <th scope="row"><small>{{ $item -> starttime }}</small></th>
                        <td><small>{{ $item -> endtime }}</small></td>
                        <td><small>{{ $item -> description }}</small></td>
                        <td><small>{{ $item -> workorder }}</small></td>
                        <td class="text-right"><small>{{ $item -> worktime_hours }}</small></td>
                        <td class="text-right"><small>{{ $item -> overtime_hours }}</small></td>
                        <td class="text-right">
                            <a href="{{ route('worktimes.delete', $item -> id) }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    <tr><th colspan="7">&nbsp;</th></tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="row">
        <small>Nema današnjih unosa.</small>
    </div>
@endif
@endsection
