<div class="card border-dark">
    <div class="card-body">
        <div class="row">
            <div class="col-2 text-center">Datum</div>
            <div class="col-2 text-right">Radni sati:</div>
            <div class="col-2 text-right">Opterećeni sati:</div>
            <div class="col-2 text-right">Startovi motora:</div>
            <div class="col text-truncate">Komentar</div>
        </div>
        <hr />
        @foreach($workinghours as $workinghour)
        <div class="row">
            <div class="col-2 text-center">{{ date('d. m. Y.', strtotime($workinghour -> date)) }}</div>
            <div class="col-2 text-right">{{ $workinghour -> total }}h</div>
            <div class="col-2 text-right">{{ $workinghour -> loaded }}h</div>
            <div class="col-2 text-right">{{ $workinghour -> starts }} </div>
            <div class="col text-truncate">{{ $workinghour -> comment }}</div>
        </div>
        @endforeach
    </div>
        <div class="card-footer bg-dark text-white text-right">
            <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cCompressorWorkHours" role="button" aria-expanded="false" aria-controls="cCompressorWorkHours">
                <small>Radni sati kompresora</small>
            </a>
    </div>
</div>
