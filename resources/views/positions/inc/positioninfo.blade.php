<div class="card border-dark">
    <div class="card-header bg-dark text-white text-right">
        <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cInfo" role="button" aria-expanded="false" aria-controls="cInfo">
            <small>Karakteristike</small>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-borderless">
                <tbody>
                    <tr>
                        <td><small>Pozicija:</small></td>
                        <td><small>{{ $position -> position }}</small></td>
                    </tr>
                    <tr>
                        <td><small>Tip:</small></td>
                        <td><small>{{ $position -> type }}</small></td>
                    </tr>
                    <tr>
                        <td><small>Proizvođač:</small></td>
                        <td><small>{{ $position -> manufacturer }}</small></td>
                    </tr>
                    <tr>
                        <td><small>Godina:</small></td>
                        <td><small>{{ $position -> year }}</small></td>
                    </tr>
                    <tr>
                        <td><small>Kapacitet:</small></td>
                        <td><small>{{ $position -> capacity }}: {{ $position -> capacity1 }}</small></td>
                    </tr>
                    <tr>
                        <td><small>Snaga:</small></td>
                        <td><small>{{ $position -> power }}: {{ $position -> power1 }}</small></td>
                    </tr>
                    <tr>
                        <td><small>Brzina:</small></td>
                        <td><small>{{ $position -> speed }}: {{ $position -> speed1 }}</small></td>
                    </tr>
                    <tr>
                        <td><small>Troškovna jedinica:</small></td>
                        <td><small>{{ $position -> unit -> unit_number }}: {{ $position -> unit -> description }}</small></td>
                    </tr>
                    <tr>
                        <td><small>Vrsta uređaja:</small></td>
                        <td><small>{{ $position -> devicetype -> type }}</small></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
