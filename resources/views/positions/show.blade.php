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

<div class= "row">
<div class= "col-8">
    <div class="card">
        <div class="card-header">
            <strong>{{ $position -> position }}</strong> - {{ $position -> name }}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-4">Tip:</div>
                <div class="col">{{ $position -> type }}</div>
            </div>

            <div class="row">
                <div class="col-4">Proizvođač:</div>
                <div class="col">{{ $position -> manufacturer }}</div>
            </div>

            <div class="row">
                <div class="col-4">Godina proizvodnje:</div>
                <div class="col">{{ $position -> year }}</div>
            </div>

            <div class="row">
                <div class="col-4">Kapacitet:</div>
                <div class="col">{{ $position -> capacity }} {{ $position -> capacity1 }}</div>
            </div>

            <div class="row">
                <div class="col-4">Brzina:</div>
                <div class="col">{{ $position -> speed }} {{ $position -> speed1 }}</div>
            </div>

            <div class="row">
                <div class="col-4">Snaga:</div>
                <div class="col">{{ $position -> power }} {{ $position -> power1 }}</div>
            </div>
        </div>
    </div>
</div>

<div class= "col-4">
    <div class="card">
        <div class="card-header">
            Statistika
        </div>

        <div class="card-body">
            
        </div>
    </div>
    <br />
    <div class="btn-group btn-block" role="group" arial-label="Mogućnosti">
            {{-- <a href="{{ route('workorders.create', $position ->id) }}" class="btn btn-success btn-sm">&nbsp;&nbsp;Novi nalog&nbsp;&nbsp;</a> --}}
            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#newrevision">Nova revizija</a>
            {{-- <a href="{{ route('troubleshootings.create', $position -> id) }}" class="btn btn-success btn-sm" >Nova PK</a>  --}}
    </div>
</div>
</div>


</div>
@endsection