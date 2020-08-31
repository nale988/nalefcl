<div class="card border-dark">
    <div class="card-header bg-dark text-white text-right">
        <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cRevisions" role="button" aria-expanded="false" aria-controls="cRevisions">
            <small>Napomene</small>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-inverse">
                    <tr>
                        <th>Opis</th>
                        <th class="text-center">Datum</th>
                        <th class="text-center">
                            @include('layouts.buttons.btnuser', ['color' => 'currentColor'])
                        </th>
                        <th class="text-right" >Opcije</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($revisions as $revision)
                @if($revision -> private_item && (!$userrole -> private_items || $revision -> user_id <> $user -> id))
                    <tr style="display: none;">
                @else
                    <tr>
                @endif
                    <td class="text-nowrap">
                        @if($revision -> private_item && $userrole -> private_items && $revision -> user_id == $user -> id)
                        <strong>{{ strip_tags($revision -> description) }}</strong>
                        @else
                        {{ strip_tags($revision -> description) }}
                        @endif
                    </td>

                    <td class="text-nowrap text-center">
                        {{ date('d. m. Y.', strtotime($revision -> created_at)) }}
                    </td>

                    <td class="text-nowrap text-center">
                        {{ explode(' ', $revision -> user -> name)[1] }}
                    </td>

                    <td class="text-nowrap text-right">
                        @if(count($revision -> files) > 0)
                            @foreach($revision -> files as $file)
                                <a href="{{ URL::asset($file -> url ) }}" style="text-decoration:none; color:#000000;">
                                    @include('layouts.buttons.btnfile', ['color' => 'currentColor'])
                                </a>
                            @endforeach
                        @endif

                        @if($revision -> user -> id == $user -> id)
                            <a href="{{ route('revisions.edit', $revision -> id)}}">
                                @include('layouts.buttons.btnedit', ['color' => 'currentColor'])
                            </a>
                        @endif

                        <a href="#" data-toggle="modal" data-target="#modalrev-{{ $revision -> id }}" >
                            @include('layouts.buttons.btnreadmore', ['color' => 'currentColor'])
                        </a>

                        <div class="modal fade col" id="modalrev-{{ $revision -> id }}" tabindex="-1" role="dialog" aria-labelledby="descrev-{{ $revision -> id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalrev-{{ $revision -> id }}">Detalji napomene</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body d-flex text-justify">
                                    {!! $revision -> description !!}
                                </div>
                                <div class="modal-footer">
                                    @if(count($revision -> files) > 0)
                                        @foreach($revision -> files as $file)
                                            <a class="btn btn-dark" href="{{ URL::asset($file -> url ) }}">{{ $file -> filename }}</a>
                                        @endforeach
                                    @endif
                                  &nbsp;&nbsp;
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </td>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
