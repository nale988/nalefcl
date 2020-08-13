<div class="card border-dark">
    <div class="card-body">
        <div class="row">
            <div class="col-2 text-center">Datum</div>
            <div class="col-1 text-center">Tip:</div>
            <div class="col-1 text-right">Sati:</div>
            <div class="col text-truncate">Komentar</div>
            <div class="col-1">&nbsp;</div>
        </div>
        <hr />
        @foreach($compressorservices as $compressorservice)
        <div class="row">
            <div class="col-2 text-center">{{ date('d. m. Y.', strtotime($compressorservice -> date)) }}</div>
            <div class="col-1 text-center"><strong>{{ $compressorservice -> type }}</strong></div>
            <div class="col-1 text-right">{{ $compressorservice -> total }}h</div>
            <div class="col text-truncate">{{ $compressorservice -> comment }}</div>
            <div class="col-1">
                @foreach($compressorservice -> files as $file)
                    <a href="{{ URL::asset($file -> url ) }}" style="text-decoration:none; color:#000000;">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                            <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cCompressorServices" role="button" aria-expanded="false" aria-controls="cCompressorServices">
        <div class="card-footer bg-dark text-white text-right">
            Servisi
        </div>
    </a>
</div>
