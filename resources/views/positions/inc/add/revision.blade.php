<div class="card">
    <!-- napomene -->
    <div class="card-header bg-secondary text-white">
        Napomene
    </div>
    <div class="card-body">
        <form class="m-2" method="post" action="{{ route('revisions.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="revision-content">Nova napomena</label>
                <textarea class="form-control" name="revision_description" rows="3"></textarea>
            </div>

            <input type="hidden" name="revision_position_id" value="{{ $position -> id }}">

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input id="file" type="file" name="file">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    @if($userrole -> private_items)
                    <div class="form-check form-check-inline">
                        <input type="hidden" value="0" name="revision_private" id="revision_private">
                        <input class="form-check-input" type="checkbox" value="1" name="revision_private" id="revision_private">
                        <label class="form-check-label" for="revision_private">
                            <span class="mx-2">Privatno?</span>
                        </label>
                    </div>
                    @else
                        <input type="hidden" name="revision_private" id="revision_private" value="0">
                    @endif
                </div>
                <div class="col-6 text-right">
                    <button type="submit" class="btn btn-primary float-right" value="submit" name="revision_submit">Sačuvaj</button>
                </div>
            </div>
        </form>
    </div>
</div>
