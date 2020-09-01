    @if($userrole -> files_add)
        @include('positions.inc.add.document')
        <br />
    @endif

    @if($userrole -> services_add)
        @if($position -> devicetype -> id == 3)
            @include('positions.inc.add.servicecompressor')
            <br />
        @endif

        @if($position -> devicetype -> id == 6)
            @include('positions.inc.add.serviceblower')
            <br />
        @endif
    @endif

    @if($userrole -> workhours_add)
        @if($position -> devicetype -> id == 3)
            @include('positions.inc.add.workhourscompressor')
            <br />
        @endif
    @endif

    @if($userrole -> revisions_add)
        @include('positions.inc.add.revision')
        <br />
    @endif

    @if($userrole -> workorders_add)
        {{-- ToDo: finish --}}
    @endif

    @if($userrole -> lubrications_add)
        {{-- ToDo: finish --}}
    @endif
