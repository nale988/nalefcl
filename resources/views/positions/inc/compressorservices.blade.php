<div class="card border-dark">
    <div class="card-header bg-dark text-white text-right">
        <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cCompressorServices" role="button" aria-expanded="false" aria-controls="cCompressorServices">
            <small>Servisi</small>
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover table-sm">
            <thead class="thead-inverse">
                <tr>
                    <th class="text-center" style="white-space: nowrap;">Datum</th>
                    <th class="text-center" style="white-space: nowrap;">Tip</th>
                    <th class="text-right" style="white-space: nowrap;">Sati</th>
                    <th class="text-truncate" style="white-space: nowrap;">Komentar</th>
                    <th class="text-right" style="white-space: nowrap;">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($compressorservices as $compressorservice)
                <tr>
                    <td style="white-space: nowrap;">
                        {{ date('d. m. Y.', strtotime($compressorservice -> date)) }}
                    </td>
                    <td class="text-center" style="white-space: nowrap;"><strong>{{ $compressorservice -> type }}</strong></td>
                    <td class="text-right" style="white-space: nowrap;">{{ $compressorservice -> total }}h</td>
                    <td class="text-truncate" style="white-space: nowrap;">{{ $compressorservice -> comment }}</td>
                    <td style="white-space: nowrap;">
                    @foreach($compressorservice -> files as $file)
                        <a href="{{ URL::asset($file -> url ) }}" style="text-decoration:none; color:#000000;">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                                <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </a>
                    @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
