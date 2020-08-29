@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header bg-dark text-white">
        Dozvole korisnika
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
                        <input type="hidden" value="0" name="permission_services" id="permission_services">
                        <input class="form-check-input" type="checkbox" name="permission_services" id="permission_services" {{ $selectedrole -> services ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_services">
                            <span class="mx-2">Servisi duvaljki i kompresora</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_workhours" id="permission_workhours">
                        <input class="form-check-input" type="checkbox" name="permission_workhours" id="permission_workhours" {{ $selectedrole -> workhours ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_workhours">
                            <span class="mx-2">Radni sati kompresora</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_workorders" id="permission_workorders">
                        <input class="form-check-input" type="checkbox" name="permission_workorders" id="permission_workorders" {{ $selectedrole -> workorders ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_workorders">
                            <span class="mx-2">Otvaranje radnih naloga</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_lubrications" id="permission_lubrications">
                        <input class="form-check-input" type="checkbox" name="permission_lubrications" id="permission_lubrications" {{ $selectedrole -> lubrications ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_lubrications">
                            <span class="mx-2">Podmazivanje</span>
                        </label>
                    </div>

                    <div class="form-check">
                        <input type="hidden" value="0" name="permission_files" id="permission_files">
                        <input class="form-check-input" type="checkbox" name="permission_files" id="permission_files" {{ $selectedrole -> files ? 'checked':'' }}>
                        <label class="form-check-label" for="permission_files">
                            <span class="mx-2">Dokumenti</span>
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
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right" value="submit" name="revision_submit">Sačuvaj</button>
        </form>
    </div>
</div>
@endsection
