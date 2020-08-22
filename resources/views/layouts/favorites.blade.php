<h4 class="text-white"><u>Odabrane pozicije</u></h4>
<ul class="list-unstyled">
    @foreach($favorites as $favorite)
        <li><small><a href="{{ route('positions.show', $favorite->position_id) }}" class="text-white text-truncate" style="text-decoration:none;">&nbsp;&nbsp;&nbsp;{{ $favorite -> position }} - {{ $favorite -> name }}</a></small></li>
    @endforeach
</ul>
