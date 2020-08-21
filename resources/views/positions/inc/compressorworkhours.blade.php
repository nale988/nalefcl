<div class="card border-dark">
    <div class="card-header bg-dark text-white text-right">
        <a class="btn btn-dark btn-sm" data-toggle="collapse" href="#cCompressorWorkHours" role="button" aria-expanded="false" aria-controls="cCompressorWorkHours">
            <small>Radni sati kompresora</small>
        </a>
    </div>
    <div class="card-body">
        <table class="table table-hover table-sm">
            <thead class="thead-inverse">
                <tr>
                    <th class="text-center">Datum</th>
                    <th class="text-right">Radni sati</th>
                    <th class="text-right">Opterećeni sati</th>
                    <th class="text-right">Startovi motora</th>
                    <th class="text-truncate">Komentar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workinghours as $workinghour)
                <tr>
                    <td>
                        <a href="{{ route('editworkinghours', $workinghour -> id)}}">
                        {{ date('d. m. Y.', strtotime($workinghour -> date)) }}
                        </a>
                    </td>
                    <td class="text-right">{{ $workinghour -> total }}h</td>
                    <td class="text-right">{{ $workinghour -> loaded }}h</td>
                    <td class="text-right">{{ $workinghour -> starts }}h</td>
                    <td class="text-truncate">{{ $workinghour -> comment }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
