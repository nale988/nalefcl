<div class="card border-dark">
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                    Dodaj dokumentaciju za poziciju
            </div>
            <div class="card-body">
                {{-- enctype attribute is important if your form contains file upload --}}
                {{-- Please check https://www.w3schools.com/tags/att_form_enctype.asp for further info --}}
                <form class="m-2" method="post" action="{{ route('uploadpositionfile') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="position_id" value="{{ $position -> id }}" />
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input id="file" type="file" name="file">
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-dark btn-sm">Dodaj dokument</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($position -> devicetype -> id == 3)
            @if($userrole -> workhours == 1)
            <br />
            <div class="card">
                <div class="card-header">
                    Dodaj radne sate za kompresor
                </div>
                <div class="card-body">
                    <form class="m-2" method="post" action="{{ route('storeworkinghours') }}">
                        @csrf
                        <input type="hidden" name="position_id" value="{{ $position -> id }}" />
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    @if(!empty($lastworkinghours->total))
                                    <input type="text" name="total" class="form-control" placeholder="{{ $lastworkinghours -> total }}h" />
                                    @else
                                    <input type="text" name="total" class="form-control" placeholder="Radni sati" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    @if(!empty($lastworkinghours->loaded))
                                        <input type="text" name="loaded" class="form-control" placeholder="{{ $lastworkinghours -> loaded}}h" />
                                    @else
                                        <input type="text" name="loaded" class="form-control" placeholder="Opterećeni sati" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    @if(!empty($lastworkinghours->starts))
                                        <input type="text" name="starts" class="form-control" placeholder="{{ $lastworkinghours -> starts }}" />
                                    @else
                                        <input type="text" name="starts" class="form-control" placeholder="Startovi motora" />
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="description">Komentar:</label>
                                    <textarea class="form-control" name="comment" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="date">Datum mjerenja:</label>
                                    <input type="date" name="date" class="form-control" value="{{ now()->format('Y-m-d') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-dark btn-sm">Sačuvaj radne sate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        @endif

        @if($position -> devicetype -> id == 3)
            @if($userrole -> services == 1)
            <br />
            <div class="card">
                <div class="card-header">
                    Dodaj servis za kompresor
                </div>
                <div class="card-body">
                    <form class="m-2" method="post" action="{{ route('storecompressorservice') }}" enctype="multipart/form-data">
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
                                    <input type="text" name="type" class="form-control" placeholder="Vrsta servisa" />
                                </div>
                            </div>
                            <div class="col-4">
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
                            <div class="col-8">
                                <div class="form-group">
                                    <input id="file" type="file" name="file">
                                </div>
                            </div>
                            <div class="col-4 text-right">
                                <button type="submit" class="btn btn-dark btn-sm">Sačuvaj servis</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        @endif

        <br />

        <div class="card">
            <div class="card-header">
                Napomene
            </div>
            <div class="card-body">
                <form class="m-2" method="post" action="{{ route('revisions.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="revision-content">Nova napomena</label>
                        <textarea class="form-control" name="revision_description" rows="6"></textarea>
                    </div>

                    <input type="hidden" name="revision_position_id" value="{{ $position -> id }}">
                    <div class="row">
                        <div class="col">&nbsp;</div>
                        <div class="col-4">
                            <div class="form-group">
                                <input id="file" type="file" name="file">
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary" value="submit" name="revision_submit">Sačuvaj</button>
                        </div>
                    </div>
                </form>
            </div>

    </div>
    <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cAddNew" role="button" aria-expanded="false" aria-controls="cAddNew">
        <div class="card-footer bg-dark text-white text-right">
            Dodaj novo...
        </div>
    </a>

</div>
