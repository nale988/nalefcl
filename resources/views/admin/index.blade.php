@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-dark text-white">
        Posljednji podaci o posjetama
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-stripped">
                <thead>
                    <th scope="col">IP</th>
                    <th scope="col">IP proxy</th>
                    <th scope="col">User agent</th>
                    <th scope="col">Stranica</th>
                    <th scope="col">Grad</th>
                    <th scope="col">Korisnik</th>
                    <th scope="col">Datum</th>
                    <th scope="col">Vrijeme</th>
                </thead>
                <tbody>
                @foreach($last_visits as $visit)
                    @if($visit->mobile == 1)
                        <tr class="table-success">
                    @else
                        <tr>
                    @endif
                        <th scope="row"><small>{{ $visit -> ip }}</small></th>
                        <td class="text-nowrap"><small>{{ $visit -> ip_proxy }}</small></td>
                        <td class="text-nowrap"><small>{{ substr($visit -> useragent, 0, 40) }}</small></td>
                        <td class="text-nowrap"><small>{{ substr($visit -> page, strlen($visit->page)-50, 50) }}</small></td>
                        <td class="text-nowrap"><small>{{ $visit -> mobile }}</small></td>
                        <td class="text-nowrap"><small>{{ $visit -> user_id }}</small></td>
                        <td class="text-nowrap"><small>{{ date('d. m. y.', strtotime($visit -> created_at)) }}</small></td>
                        <td class="text-nowrap"><small>{{ date('H:i:s', strtotime($visit -> created_at)) }}</small></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <br />
        <div aria-label="Pagination" class="pagination pagination-sm justify-content-center">{!! $last_visits->render() !!}</div>
    </div>
</div>

<br />
<br />

<div class="card">
    <div class="card-header bg-dark text-white">
        Posljednji podaci o browserima
    </div>
    <div class="card-body">
        <span>Udio mobilnih browsera: {{ round(($totalcountmobile / $totalcount)*100,0)}}%</span>
        <div class="progress" style="height: 20px;">
            <div class="progress-bar bg-danger" role="progressbar" style="width:{{ round(($totalcountmobile / $totalcount)*100,0)}}%;" aria-valuenow="{{ $totalcountmobile }}" aria-valuemin="0" aria-valuemax="{{ $totalcount }}">{{ round(($totalcountmobile / $totalcount)*100, 2)}}%</div>
        </div>
        <br />
        <br />
        <div class="table-responsive">
            <table class="table table-sm table-stripped">
                <thead>
                    <th scope="col">Browser</th>
                    <th scope="col" class="text-right">Količina</th>
                </thead>
                <tbody>
                @foreach($browsers as $browser)
                    <tr>
                        <th scope="row" class="text-nowrap"><small>{{ $browser -> useragent }}</small></th>
                        <td class="text-nowrap text-right"><small>{{ $browser -> total }}</small></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
