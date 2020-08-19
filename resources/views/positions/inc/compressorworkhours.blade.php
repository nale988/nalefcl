<div class="card border-dark">
    <div class="card-header bg-dark text-white text-right">
        <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cCompressorWorkHours" role="button" aria-expanded="false" aria-controls="cCompressorWorkHours">
            <small>Radni sati kompresora</small>
        </a>
    </div>
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
            <div class="col-2 text-center">
                <a href="{{ route('editworkinghours', $workinghour -> id)}}">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                </a>&nbsp;
                {{ date('d. m. Y.', strtotime($workinghour -> date)) }}
            </div>
            <div class="col-2 text-right">{{ $workinghour -> total }}h</div>
            <div class="col-2 text-right">{{ $workinghour -> loaded }}h</div>
            <div class="col-2 text-right">{{ $workinghour -> starts }} </div>
            <div class="col text-truncate">{{ $workinghour -> comment }}</div>
        </div>
        @endforeach
    </div>
</div>
