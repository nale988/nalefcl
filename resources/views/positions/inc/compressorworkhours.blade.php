<div class="card border-dark">
    <div class="card-header bg-dark text-white text-right">
        <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cCompressorWorkHours" role="button" aria-expanded="false" aria-controls="cCompressorWorkHours">
            <small>Radni sati kompresora</small>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="thead-inverse">
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
                            <a href="{{ route('editworkinghours', $workinghour -> id)}}">
                            {{ date('d. m. Y.', strtotime($workinghour -> date)) }}
                            </a>
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
    </div>
</div>
