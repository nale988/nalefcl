<div class="card">
    <div class="card-header bg-secondary text-white">Dodaj servis za duvaljku</div>
    <div class="card-body">
        <form class="m-2" method="post" action="{{ route('storeblowerservice') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="position_id" value="{{ $position -> id }}" />
        <div class="row">
            <div class="form-check form-check-inline">
                <input type="hidden" value="0" name="inspection" id="inspection">
                <input class="form-check-input" type="checkbox" name="inspection" id="inspection">
                <label class="form-check-label" for="inspection">
                    <span class="mx-2">Pregled</span>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="hidden" value="0" name="filter" id="filter">
                <input class="form-check-input" type="checkbox" name="filter" id="filter">
                <label class="form-check-label" for="filter">
                    <span class="mx-2">Filter</span>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="hidden" value="0" name="belt" id="belt">
                <input class="form-check-input" type="checkbox" name="belt" id="belt">
                <label class="form-check-label" for="belt">
                    <span class="mx-2">Remen</span>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="hidden" value="0" name="pulley" id="pulley">
                <input class="form-check-input" type="checkbox" name="pulley" id="pulley">
                <label class="form-check-label" for="pulley">
                    <span class="mx-2">Remenica</span>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="hidden" value="0" name="oil" id="oil">
                <input class="form-check-input" type="checkbox" name="oil" id="oil">
                <label class="form-check-label" for="oil">
                    <span class="mx-2">Ulje</span>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="hidden" value="0" name="nonreturn_valve" id="nonreturn_valve">
                <input class="form-check-input" type="checkbox" name="nonreturn_valve" id="nonreturn_valve">
                <label class="form-check-label" for="nonreturn_valve">
                    <span class="mx-2">Nepovratni ventil</span>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="hidden" value="0" name="element_repair" id="element_repair">
                <input class="form-check-input" type="checkbox" name="element_repair" id="element_repair">
                <label class="form-check-label" for="element_repair">
                    <span class="mx-2">Remont elementa</span>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="hidden" value="0" name="element_replace" id="element_replace">
                <input class="form-check-input" type="checkbox" name="element_replace" id="element_replace">
                <label class="form-check-label" for="element_replace">
                    <span class="mx-2">Zamjena elementa elementa</span>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="hidden" value="0" name="first_start" id="first_start">
                <input class="form-check-input" type="checkbox" name="first_start" id="first_start">
                <label class="form-check-label" for="first_start">
                    <span class="mx-2">Puštanje u rad</span>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input type="hidden" value="0" name="other" id="other">
                <input class="form-check-input" type="checkbox" name="other" id="other">
                <label class="form-check-label" for="other">
                    <span class="mx-2">Drugo</span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="date">Datum:</label>
                    <input type="date" name="date" class="form-control" value="{{ now()->format('Y-m-d') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="description">Komentar:</label>
                    <textarea class="form-control" name="comment" rows="2"></textarea>
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
            <div class="col-12">
                <div class="form-inline float-right">
                <button type="submit" class="btn btn-dark btn-sm ml-2">Sačuvaj servis</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
