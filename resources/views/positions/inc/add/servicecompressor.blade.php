<div class="card">
    <div class="card-header bg-secondary text-white">
        Dodaj servis za kompresor
    </div>
    <div class="card-body">
        <form class="m-2" method="post" action="{{ route('storecompressorservice') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="position_id" value="{{ $position -> id }}" />
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="total" class="form-control" placeholder="Radni sati" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="type" class="form-control" placeholder="Vrsta servisa" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input type="date" name="date" class="form-control" value="{{ now()->format('Y-m-d') }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="description">Komentar:</label>
                        <textarea class="form-control" name="comment" rows="4"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input id="file" type="file" name="file">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-dark btn-sm">Sačuvaj servis</button>
                </div>
            </div>
        </form>
    </div>
</div>
