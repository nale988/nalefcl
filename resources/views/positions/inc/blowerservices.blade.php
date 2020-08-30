<div id="scoped-content">
    <style type="text/css" scoped>
        th.rotate {
            height:150px;
            white-space: nowrap;
            position:relative;
        }

        th.rotate > div {
            transform: rotate(-90deg);
            position:absolute;
            left:0;
            right:0;
            top: 105px;
            margin:auto;
        }
    </style>

<div class="card border-dark">
    <div class="card-footer bg-dark text-white text-right">
        <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cBlowerServices" role="button" aria-expanded="false" aria-controls="cBlowerServices">
            <small>Servisi</small>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" style="width: 80px; white-space: nowrap;">Datum</th>
                        <th scope="col" class="rotate"><div><span>Pregled</span></div></th>
                        <th scope="col" class="rotate"><div><span>Filter</span></div></th>
                        <th scope="col" class="rotate"><div><span>Remen</span></div></th>
                        <th scope="col" class="rotate"><div><span>Remenica</span></div></th>
                        <th scope="col" class="rotate"><div><span>Ulje</span></div></th>
                        <th scope="col" class="rotate"><div><span>Nepovratni ventil</span></div></th>
                        <th scope="col" class="rotate"><div><span>Remont elementa</span></div></th>
                        <th scope="col" class="rotate"><div><span>Zamjena elementa</span></div></th>
                        <th scope="col" class="rotate"><div><span>Puštanje u rad</span></div></th>
                        <th scope="col" class="rotate"><div><span>Ostalo</span></div></th>
                        <th scope="col" class="rotate"><div><span>Dokument</span></div></th>
                        <th scope="col">Komentar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blowerservices as $blowerservice)
                        @if($blowerservice -> element_repair)
                            <tr class="table-primary">
                        @elseif($blowerservice -> element_replace)
                            <tr class="table-danger">
                        @else
                            <tr>
                        @endif
                                <th scope="row" style="white-space: nowrap;"><small>
                                    <a href="{{ route('editblowerservice', $blowerservice -> id) }}" style="text-decoration: none; color: #000000;">
                                        {{ date('d. m. Y.', strtotime($blowerservice -> date)) }}
                                    </a>
                                </small></th>

                                <td class="text-center" style="white-space: nowrap;">
                                @if($blowerservice -> inspection)
                                    &#9746;
                                @else
                                    &#9744;
                                @endif
                                </td>

                                <td class="text-center" style="white-space: nowrap;">
                                    @if($blowerservice -> filter)
                                        &#9746;
                                    @else
                                        &#9744;
                                    @endif
                                </td>

                                <td class="text-center" style="white-space: nowrap;">
                                    @if($blowerservice -> belt)
                                        &#9746;
                                    @else
                                        &#9744;
                                    @endif
                                </td>

                                <td class="text-center" style="white-space: nowrap;">
                                    @if($blowerservice -> pulley)
                                        &#9746;
                                    @else
                                        &#9744;
                                    @endif
                                </td>

                                <td class="text-center" style="white-space: nowrap;">
                                    @if($blowerservice -> oil)
                                        &#9746;
                                    @else
                                        &#9744;
                                    @endif
                                </td>

                                <td class="text-center" style="white-space: nowrap;">
                                    @if($blowerservice -> nonreturn_valve)
                                        &#9746;
                                    @else
                                        &#9744;
                                    @endif
                                </td>

                                <td class="text-center" style="white-space: nowrap;">
                                    @if($blowerservice -> element_repair)
                                        &#9746;
                                    @else
                                        &#9744;
                                    @endif
                                </td>

                                <td class="text-center" style="white-space: nowrap;">
                                    @if($blowerservice -> element_replace)
                                        &#9746;
                                    @else
                                        &#9744;
                                    @endif
                                </td>

                                <td class="text-center" style="white-space: nowrap;">
                                    @if($blowerservice -> first_start)
                                        &#9746;
                                    @else
                                        &#9744;
                                    @endif
                                </td>

                                <td class="text-center" style="white-space: nowrap;">
                                    @if($blowerservice -> other)
                                        &#9746;
                                    @else
                                        &#9744;
                                    @endif
                                </td>

                                <td class="text-center" style="white-space: nowrap;">
                                    @if(count($blowerservice -> files)>0)
                                        @foreach($blowerservice -> files as $file)
                                        <a href="{{ URL::asset($file -> url) }}" title="{{ $file -> filename}}  //  {{ number_format(round($file -> filesize/1024, 0), 0, '.', ' ') }}kB" >
                                            @include('layouts.buttons.btnfile', ['color' => 'currentColor'])
                                        </a>
                                        @endforeach
                                    @else
                                        @include('layouts.buttons.btnfile', ['color' => 'currentColor'])
                                    @endif
                                </td>
                                <td style="white-space: nowrap;"><small>{{ $blowerservice -> comment}}</small></td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
