<div class="card-body">
    <div class="card">
        <div class="card-header bg-secondary text-white bg-secondary text-white">
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
                </div>
                <div class="row">
                    <div class="col-6">
                        @if($userrole -> private_items)
                        <div class="form-check form-check-inline">
                            <input type="hidden" value="0" name="position_file_private" id="position_file_private">
                            <input class="form-check-input" type="checkbox" value="1" name="position_file_private" id="position_file_private">
                            <label class="form-check-label" for="position_file_private">
                                <span class="mx-2">Privatno?</span>
                            </label>
                        </div>
                        @else
                            <input type="hidden" name="position_file_private" id="position_file_private" value="0">
                        @endif
                    </div>
                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-primary float-right" value="submit" >Sačuvaj</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
