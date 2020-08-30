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
                            @include('layouts.buttons.btnuser', ['color' => 'currentColor'])
                        </th>
                        <th scope="col" class="text-right text-nowrap">Datum</th>
                        <th scope="col" class="text-right text-nowrap">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($position_files as $file)
                    {{-- Privatni dokument i pripada korisniku --}}
                    @if($file -> private_item && $userrole -> private_items && $file -> user_id == $user->id)
                        <tr class="bg-warning">
                    {{-- Privatni dokument i ne pripada korisniku --}}
                    @elseif($file -> private_item && !$userrole -> private_items)
                        <tr style="display: none;">
                    {{-- Normalni dokument --}}
                    @else
                        <tr>
                    @endif
                            <td class="text-nowrap">
                                <a href="{{URL::asset($file -> url)}}" style="text-decoration:none; color:#000000;">
                                    @include('layouts.buttons.btnfile', ['color' => 'currentColor'])
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
                                    @include('layouts.buttons.btndelete', ['color' => 'currentColor'])
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
                                                <p>Ukloniti dokument&nbsp;&nbsp;<strong>{{$file -> filename}}</strong>?</p>
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
