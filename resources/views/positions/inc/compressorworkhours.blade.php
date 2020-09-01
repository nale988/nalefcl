<div class="table-responsive">
    <table class="table table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th class="text-center" style="white-space: nowrap;">Datum</th>
                <th class="text-right" style="white-space: nowrap;">Radni sati</th>
                <th class="text-right" style="white-space: nowrap;">Opterećeni sati</th>
                <th class="text-right" style="white-space: nowrap;">Startovi motora</th>
                <th class="text-truncate" style="white-space: nowrap;">Komentar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($workinghours as $workinghour)
            <tr>
                <td style="white-space: nowrap;">
                    @if($userrole -> workhours_add)
                    <a href="{{ route('editworkinghours', $workinghour -> id)}}">
                    {{ date('d. m. Y.', strtotime($workinghour -> date)) }}
                    </a>
                    @else
                    {{ date('d. m. Y.', strtotime($workinghour -> date)) }}
                    @endif
                </td>
                <td class="text-right" style="white-space: nowrap;">{{ $workinghour -> total }}h</td>
                <td class="text-right" style="white-space: nowrap;">{{ $workinghour -> loaded }}h</td>
                <td class="text-right" style="white-space: nowrap;">{{ $workinghour -> starts }}h</td>
                <td class="text-truncate" style="white-space: nowrap;">{{ $workinghour -> comment }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
