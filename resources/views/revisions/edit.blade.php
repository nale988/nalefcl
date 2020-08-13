@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                Uredi reviziju
            </div>
            <div class="col-2 text-right">
                <button type="button" class="close" data-toggle="modal" data-target="#deleteModal">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteRevision" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteRevision">Obriši</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Jeste li sigurni da želite obrisati reviziju?
              </div>
              <div class="modal-footer">
                  <form action="{{ route('revisions.destroy', $revision -> id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                        <button type="submit" class="btn btn-danger">Obriši</button>
                  </form>
              </div>
            </div>
          </div>
    </div>

    <div class="card-body">
        <form action="{{ route('revisions.update', $revision -> id) }}" method="POST" enctype="multipart/form-data" >
            @method('PUT')
            @csrf
            <input type="hidden" name="revision_id" value="{{ $revision -> id }}" />
            <div class="form-group">
                <label for="description">Sadržaj:</label>
                <textarea class="form-control" id="description" name="description" rows="5">{!! strip_tags($revision -> description) !!}</textarea>
            </div>
            @if(count($revision -> files)>0)
            <br />
            <div class="row">
                <div class="col-2">Prikačeni dokument:</div>
                <div class="col">
                    @foreach($revision -> files as $file)
                    <a href="{{ URL::asset($file -> url ) }}">
                        {{ $file -> filename }}
                    </a>

                    <a href="{{ route('removerevisionfile', $file -> id) }}">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                        </svg>
                    </a>
                    @endforeach
                </div>
                <div class="col-1 text-right">
                </div>
            </div>
            @else
                <div class="card">
                    <div class="card-header">Prikači dokument</div>
                    <div class="card-body">
                        <input id="file" type="file" name="file">
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col">&nbsp;</div>
                <div class="col-2 text-right">
                    <button class="btn btn-primary btn-block" type="submit">Sačuvaj!</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
    </div>
</div>
</div>
@endsection
