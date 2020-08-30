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
                        <td style=" width: 110px;"><small>Pozicija:</small></td>
                        <td><small><strong>{{ $position -> position }}</strong></small></td>
                    </tr>
                    <tr>
                        <td style=" width: 110px;"><small>Ime:</small></td>
                        <td><small><strong>{{ $position -> name }}</strong></small></td>
                    </tr>
                    <tr>
                        <td style=" width: 110px;"><small>Tip:</small></td>
                        <td><small><strong>{{ $position -> type }}</strong></small></td>
                    </tr>
                    <tr>
                        <td style=" width: 110px;"><small>Proizvođač:</small></td>
                        <td><small><strong>{{ $position -> manufacturer }}</strong></small></td>
                    </tr>
                    <tr>
                        <td style=" width: 110px;"><small>Godina:</small></td>
                        <td><small><strong>{{ $position -> year }}</strong></small></td>
                    </tr>
                    <tr>
                        <td style=" width: 110px;"><small>Kapacitet:</small></td>
                        <td><small><strong>{{ $position -> capacity }}: {{ $position -> capacity1 }}</strong></small></td>
                    </tr>
                    <tr>
                        <td style=" width: 110px;"><small>Snaga:</small></td>
                        <td><small><strong>{{ $position -> power }}: {{ $position -> power1 }}</strong></small></td>
                    </tr>
                    <tr>
                        <td style=" width: 110px;"><small>Brzina:</small></td>
                        <td><small><strong>{{ $position -> speed }}: {{ $position -> speed1 }}</strong></small></td>
                    </tr>
                    <tr>
                        <td style=" width: 110px;"><small>Troškovna jedinica:</small></td>
                        <td><small><strong>
                            <a href="{{ route('showunits', $position -> unit -> id)}}">
                                {{ $position -> unit -> unit_number }}: {{ $position -> unit -> description }}
                            </a>
                            </strong></small>
                        </td>
                    </tr>
                    <tr>
                        <td style=" width: 110px;"><small>Vrsta uređaja:</small></td>
                        <td><small><strong>{{ $position -> devicetype -> type }}</strong></small></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
