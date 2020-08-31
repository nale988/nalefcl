@extends('layouts.app')
@section('content')
<div class="table-responsive">
    <table class="table table-sm table-stripped">
        <caption>Posljednje posjete</caption>
        <thead>
            <th scope="col">IP</th>
            <th scope="col">IP proxy</th>
            <th scope="col">User agent</th>
            <th scope="col">Stranica</th>
            <th scope="col">Grad</th>
            <th scope="col" class="text-center">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                    <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                </svg>
            </th>
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
                <td class="text-nowrap"><small>{{ $visit -> city }}</small></td>
                <td class="text-nowrap text-center"><small>{{ $visit -> user_id }}</small></td>
                <td class="text-nowrap"><small>{{ date('d. m. y.', strtotime($visit -> created_at -> add(Config::get('sitesettings.timezoneoffset')))) }}</small></td>
                <td class="text-nowrap"><small>{{ date('H:i:s', strtotime($visit -> created_at -> add(Config::get('sitesettings.timezoneoffset')))) }}</small></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<br />
<div aria-label="Pagination" class="pagination pagination-sm justify-content-center">{!! $last_visits->render() !!}</div>

<br />
<hr />
<br />

<span>Udio mobilnih browsera: {{ round(($totalcountmobile / $totalcount)*100,0)}}%</span>
<div class="progress" style="height: 20px;">
    <div class="progress-bar bg-danger" role="progressbar" style="width:{{ round(($totalcountmobile / $totalcount)*100,0)}}%;" aria-valuenow="{{ $totalcountmobile }}" aria-valuemin="0" aria-valuemax="{{ $totalcount }}">{{ round(($totalcountmobile / $totalcount)*100, 2)}}%</div>
</div>
<br />
<br />
<div class="table-responsive">
    <table class="table table-sm table-stripped">
        <caption>Browseri</caption>
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

@endsection
