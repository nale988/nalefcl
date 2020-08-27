<div class="card border-dark">
    <div class="card-header bg-dark text-white text-right">
        <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cDocuments" role="button" aria-expanded="false" aria-controls="cDocuments">
            <small>Dokumenti</small>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-hover table-sm">
                <thead class="thead-inverse">
                    <tr>
                        <th>Naslov</th>
                        <th scope="col" class="text-right text-nowrap">Veličina</th>
                        <th scope="col" class="text-center text-nowrap">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                                <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                            </svg>
                        </th>
                        <th scope="col" class="text-right text-nowrap">Datum</th>
                        <th scope="col" class="text-right text-nowrap">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($position_files as $file)
                        @if($file -> private_item == 1 && $file -> user_id = $user -> id)
                            <tr class="bg-warning">
                        @else
                            <tr>
                        @endif
                            <td class="text-nowrap">
                                <a href="{{URL::asset($file -> url)}}" style="text-decoration:none; color:#000000;">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
                                        <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
                                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                    {{ $file -> filename }}
                                </a>
                            </td>

                            <td class="text-right text-nowrap">
                                {{ number_format(round($file -> filesize/1024, 0), 0, '.', ' ') }}kB
                            </td>

                            <td class="text-center text-nowrap">
                                {{ explode(' ', $file -> user_name)[1] }}
                            </td>

                            <td class="text-right" style="white-space: nowrap;">
                                {{ date('d. m. Y.', strtotime($file -> created_at)) }}
                            </td>
                            <td class="text-right text-nowrap">
                                <a href="#" data-toggle="modal" data-target="#modalfile-{{ $file -> id }}" >
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-diamond" fill="red" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                    </svg>
                                </a>
                                <div class="modal fade col" id="modalfile-{{ $file -> id }}" tabindex="-1" role="dialog" aria-labelledby="descfile-{{ $file -> id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalfile-{{ $file -> id }}">Ukloni dokument</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body d-flex text-justify">
                                            Ukloniti dokument&nbsp;&nbsp;<strong>{{$file -> filename}}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                                            <a href="{{ route('removepositionfile', $file -> id) }}" class="btn btn-danger">Ukloni</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
