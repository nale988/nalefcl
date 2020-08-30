@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header bg-dark text-white">
        Dozvole korisnika
        <a class="float-right btn btn-dark btn-sm" href="{{ route('admin.users')}} ">Nazad<a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.update', $selecteduser -> id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Ime</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" value="{{ $selecteduser -> name }}">
                    </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" value="{{ $selecteduser -> email }}">
                    </div>
            </div>
            <div class="row">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_admin" id="permission_admin">
                        <input class="form-check-input" type="checkbox" name="permission_admin" id="permission_admin" {{ $selectedrole -> admin ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_admin">
                            <span class="mx-2">Administrator</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_todos" id="permission_todos">
                        <input class="form-check-input" type="checkbox" name="permission_todos" id="permission_todos" {{ $selectedrole -> todos ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_todos">
                            <span class="mx-2">ToDos</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_spare_parts_view" id="permission_spare_parts_view">
                        <input class="form-check-input" type="checkbox" name="permission_spare_parts_view" id="permission_spare_parts_view" {{ $selectedrole -> spare_parts_view ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_spare_parts_view">
                            <span class="mx-2">Rezervni dijelovi (pregled)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_spare_parts_add" id="permission_spare_parts_add">
                        <input class="form-check-input" type="checkbox" name="permission_spare_parts_add" id="permission_spare_parts_add" {{ $selectedrole -> spare_parts_add ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_spare_parts_add">
                            <span class="mx-2">Rezervni dijelovi (dodavanje)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_spare_parts_order" id="permission_spare_parts_order">
                        <input class="form-check-input" type="checkbox" name="permission_spare_parts_order" id="permission_spare_parts_order" {{ $selectedrole -> spare_parts_order ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_spare_parts_order">
                            <span class="mx-2">Rezervni dijelovi (narudžbe)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_revisions_view" id="permission_revisions_view">
                        <input class="form-check-input" type="checkbox" name="permission_revisions_view" id="permission_revisions_view" {{ $selectedrole -> revisions_view ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_revisions_view">
                            <span class="mx-2">Napomene (pregled)</span>
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_revisions_add" id="permission_revisions_add">
                        <input class="form-check-input" type="checkbox" name="permission_revisions_add" id="permission_revisions_add" {{ $selectedrole -> revisions_add ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_revisions_add">
                            <span class="mx-2">Napomene (dodavanje)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_services_view" id="permission_services_view">
                        <input class="form-check-input" type="checkbox" name="permission_services_view" id="permission_services_view" {{ $selectedrole -> services_view ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_services_view">
                            <span class="mx-2">Servisi duvaljki i kompresora (pregled)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_services_add" id="permission_services_add">
                        <input class="form-check-input" type="checkbox" name="permission_services_add" id="permission_services_add" {{ $selectedrole -> services_add ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_services_add">
                            <span class="mx-2">Servisi duvaljki i kompresora (dodavanje)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_workhours_view" id="permission_workhours_view">
                        <input class="form-check-input" type="checkbox" name="permission_workhours_view" id="permission_workhours_view" {{ $selectedrole -> workhours_view ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_workhours_view">
                            <span class="mx-2">Radni sati kompresora (pregled)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_workhours_add" id="permission_workhours_add">
                        <input class="form-check-input" type="checkbox" name="permission_workhours_add" id="permission_workhours_add" {{ $selectedrole -> workhours_add ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_workhours_add">
                            <span class="mx-2">Radni sati kompresora (dodavanje)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_workorders_view" id="permission_workorders_view">
                        <input class="form-check-input" type="checkbox" name="permission_workorders_view" id="permission_workorders_view" {{ $selectedrole -> workorders_view ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_workorders_view">
                            <span class="mx-2">Radni nalozi (pregled)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_workorders_add" id="permission_workorders_add">
                        <input class="form-check-input" type="checkbox" name="permission_workorders_add" id="permission_workorders_add" {{ $selectedrole -> workorders_add ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_workorders_add">
                            <span class="mx-2">Radni nalozi (dodavanje)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_lubrications_view" id="permission_lubrications_view">
                        <input class="form-check-input" type="checkbox" name="permission_lubrications_view" id="permission_lubrications_view" {{ $selectedrole -> lubrications_view ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_lubrications_view">
                            <span class="mx-2">Podmazivanje (pregled)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_lubrications_add" id="permission_lubrications_add">
                        <input class="form-check-input" type="checkbox" name="permission_lubrications_add" id="permission_lubrications_add" {{ $selectedrole -> lubrications_add ? 'checked':'' }}>
                        <label class="form-check-label" for="permissionpermission_lubrications_add_lubrications">
                            <span class="mx-2">Podmazivanje (dodavanje)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_files_view" id="permission_files_view">
                        <input class="form-check-input" type="checkbox" name="permission_files_view" id="permission_files_view" {{ $selectedrole -> files_view ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_files_view">
                            <span class="mx-2">Dokumenti (pregled)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_files_add" id="permission_files_add">
                        <input class="form-check-input" type="checkbox" name="permission_files_add" id="permission_files_add" {{ $selectedrole -> files_add ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_files_add">
                            <span class="mx-2">Dokumenti (dodavanje)</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_private" id="permission_private">
                        <input class="form-check-input" type="checkbox" name="permission_private" id="permission_private" {{ $selectedrole -> private_items ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_private">
                            <span class="mx-2">Privatne stvari</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_worktimes" id="permission_worktimes">
                        <input class="form-check-input" type="checkbox" name="permission_worktimes" id="permission_worktimes" {{ $selectedrole -> worktimes ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_worktimes">
                            <span class="mx-2">Lični radni sati</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_favorites" id="permission_favorites">
                        <input class="form-check-input" type="checkbox" name="permission_favorites" id="permission_favorites" {{ $selectedrole -> favorites ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_favorites">
                            <span class="mx-2">Omiljene pozicije</span>
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right" value="submit" name="revision_submit">Sačuvaj</button>
            <br />
        </form>
    </div>
</div>
@endsection
