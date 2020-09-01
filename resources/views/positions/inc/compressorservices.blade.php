<div class="table-responsive">
    <table class="table table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th class="text-center" style="white-space: nowrap;">Datum</th>
                <th class="text-center" style="white-space: nowrap;">Tip</th>
                <th class="text-right" style="white-space: nowrap;">Sati</th>
                <th class="text-truncate" style="white-space: nowrap;">Komentar</th>
                <th class="text-right" style="white-space: nowrap;">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compressorservices as $compressorservice)
            <tr>
                <td style="white-space: nowrap;">
                    {{ date('d. m. Y.', strtotime($compressorservice -> date)) }}
                </td>
                <td class="text-center" style="white-space: nowrap;"><strong>{{ $compressorservice -> type }}</strong></td>
                <td class="text-right" style="white-space: nowrap;">{{ $compressorservice -> total }}h</td>
                <td class="text-truncate" style="white-space: nowrap;">{{ $compressorservice -> comment }}</td>
                <td style="white-space: nowrap;">
                @foreach($compressorservice -> files as $file)
                    <a href="{{ URL::asset($file -> url ) }}" style="text-decoration:none; color:#000000;">
                        @include('layouts.buttons.btnfile', ['color' => 'currentColor'])
                    </a>
                @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
