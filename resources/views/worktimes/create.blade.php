@extends('layouts.app')

@section('content')
<form action="{{ route('worktimes.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <label for="starttime">Početak rada</label>
                <input type="time" class="form-control form-control-sm" name="starttime" id="starttime" value="07:00">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <label for="endtime">Kraj rada</label>
                <input type="time" class="form-control form-control-sm" name="endtime" id="endtime" value="15:30">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <label for="date">Datum</label>
                <input type="date" class="form-control form-control-sm" name="date" id="date" value="{{ now()->format('Y-m-d') }}">
            </div>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-sm-8">
            <div class="form-group mb-2">
                <label for="description">Opis</label>
                <input type="text" class="form-control form-control-sm" name="description" id="description">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <label for="workorder">Radni nalog</label>
                <input type="text" class="form-control form-control-sm" name="workorder" id="workorder">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <label for="worktime_hours">Regularni radni sati</label>
                @if(count($items)>0)
                    <input type="number" step=".1" class="form-control form-control-sm" name="worktime_hours" id="worktime_hours" value="0">
                @else
                    <input type="number" step=".1" class="form-control form-control-sm" name="worktime_hours" id="worktime_hours" value="8">
                @endif
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <label for="overtime_hours">Prekovremeni radni sati</label>
                <input type="number" step=".1" class="form-control form-control-sm" name="overtime_hours" id="overtime_hours" value="0">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <label for="freetime_hours">Slobodni sati</label>
                <input type="number" step=".1" class="form-control form-control-sm" name="freetime_hours" id="freetime_hours" value="0">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-check mb-2">
                <input type="hidden" value="0" name="regulartime" id="regulartime">
                <input class="form-check-input" type="checkbox" name="regulartime" id="regulartime" checked>
                <label class="form-check-label" for="regulartime">
                    Regularni radni sati?
                </label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-check mb-2">
                <input type="hidden" value="0" name="overtime" id="overtime">
                <input class="form-check-input" type="checkbox" name="overtime" id="overtime">
                <label class="form-check-label" for="overtime">
                    Prekovremeni radni sati?
                </label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-check mb-2">
                <input type="hidden" value="0" name="vacation" id="vacation">
                <input class="form-check-input" type="checkbox" name="vacation" id="vacation">
                <label class="form-check-label" for="overtime">
                    Godišnji odmor?
                </label>
            </div>
        </div>
    </div>
    <br />
    @if(count($items)>0)
        <div class="row">
            <table class="table table-hover table-sm">
                <caption>Današnji unosi</caption>
                <thead>
                    <tr>
                        <th scope="col">Početak</th>
                        <th scope="col">Kraj</th>
                        <th scope="col">Opis</th>
                        <th scope="col">Radni nalog</th>
                        <th scope="col" class="text-right">Sati rada</th>
                        <th scope="col" class="text-right">Prekovremeni sati</th>
                        <th scope="col" class="text-right">Opcije</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
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
                </tbody>
            </table>
        </div>
    @else
        <div class="row">
            <br />
            <small>Nema današnjih unosa.</small>
            <br />
        </div>
    @endif
    <div class="row">
        <div class="col-sm-2">
            <button class="btn btn-primary btn-block" type="submit">Sačuvaj</button>
        </div>
    </div>
    </form>

@endsection
