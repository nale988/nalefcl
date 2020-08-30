<div class="card">
    <div class="card-header bg-secondary text-white">
        Dodaj radne sate za kompresor
    </div>
    <div class="card-body">
        <form class="m-2" method="post" action="{{ route('storeworkinghours') }}">
            @csrf
            <input type="hidden" name="position_id" value="{{ $position -> id }}" />
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <input type="text" name="total" class="form-control" placeholder="Radni sati" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <input type="text" name="loaded" class="form-control" placeholder="Opterećeni sati" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <input type="text" name="starts" class="form-control" placeholder="Startovi motora" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="description">Komentar:</label>
                        <textarea class="form-control" name="comment" rows="1"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="date">Datum mjerenja:</label>
                        <input type="date" name="date" class="form-control" value="{{ now()->format('Y-m-d') }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                    <button type="submit" class="btn btn-dark btn-sm">Sačuvaj radne sate</button>
                </div>
            </div>
        </form>
    </div>
</div>
