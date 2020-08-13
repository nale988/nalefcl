<div class="card border-dark">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="col-5">Pozicija:</div>
                    <div class="col-7">{{ $position -> position }}</div>
                </div>
                <div class="row">
                    <div class="col-5">Tip:</div>
                    <div class="col-7">{{ $position -> type }}</div>
                </div>
                <div class="row">
                    <div class="col-5">Proizvođač:</div>
                    <div class="col-7">{{ $position -> manufacturer }}</div>
                </div>
                <div class="row">
                    <div class="col-5">Godina:</div>
                    <div class="col-7">{{ $position -> year }}</div>
                </div>
            </div>

            <div class="col-4">
                <div class="row">
                    <div class="col-4">Kapacitet:</div>
                    <div class="col-8">{{ $position -> capacity }}: {{ $position -> capacity1 }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Snaga:</div>
                    <div class="col-8">{{ $position -> power }}: {{ $position -> power1 }}</div>
                </div>
                <div class="row">
                    <div class="col-4">Brzina:</div>
                    <div class="col-8">{{ $position -> speed }}: {{ $position -> speed1 }}</div>
                </div>
            </div>

            <div class="col-4">
                <div class="row">
                    <div class="col-4">Jedinica:</div>
                    <div class="col-8">{{ $position -> unit -> unit_number }}: {{ $position -> unit -> description }}</div>
                </div>

                <div class="row">
                    <div class="col-4">Vrsta uređaja:</div>
                    <div class="col-8">{{ $position -> devicetype -> type }}</div>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cInfo" role="button" aria-expanded="false" aria-controls="cInfo">
        <div class="card-footer bg-dark text-white text-right">
            Karakteristike
        </div>
    </a>
</div>
