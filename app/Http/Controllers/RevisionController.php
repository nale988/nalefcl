<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Position;
use App\Revision;
use App\RevisionFile;
use App\FileUpload;

class RevisionController extends Controller
{
    public function removerevisionfile ($id){

        $file = FileUpload::where('id', $id)->first();;
        $connections = RevisionFile::where('file_upload_id', $id)->get();

        foreach($connections as $connection){
            $connection -> delete();
        }

        $file -> delete();

        return redirect() -> back() -> with('message', 'Uklonjen dokument!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'revision_description' => 'required'
        ]);

        if (Auth::check()){
            $user = Auth::user();
        }
        else{
            return view('/')->with('danger', 'Niste ulogovani!');
        }

        $revision = new Revision([
            'description' => nl2br(e($request->get('revision_description'))),
            'position_id' => $request->get('revision_position_id'),
            'user_id' => $user -> id
        ]);

        $revision -> save();
        $revision_id = $revision -> id;

        $userfolder_raw = explode('@', $user -> email);
        $userfolder = str_replace('.', '', $userfolder_raw[0]);

        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:2048',
                    'document.*' => 'required|file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:10245',
                ]);

                $extension = $request->file->extension();
                $request->file->storeAs('public/re/'.$userfolder, $request->file->hashName());

                $url = Storage::disk('revisionfiles')->url($userfolder.'/'.$request->file->hashName());

                $filesize = $request->file('file')->getSize();

                $document = new FileUpload([
                    'user_id' => $user->id,
                    'filename' => $request -> file -> getClientOriginalName(),
                    'filesize' => $filesize,
                    'url' => $url,
                ]);

                $document -> save();
                $document_id = $document->id;

                $connectfile = new RevisionFile([
                    'revision_id' => $revision_id,
                    'file_upload_id' => $document_id
                ]);

                $connectfile -> save();
            }
        }

        return redirect()->back()->with('message', 'Dodana nova revizija!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $revision = Revision::where('id', $id)->with('files')->first();
        return view('revisions.edit', compact('revision'));
    }

    public function update(Request $request, $id)
    {
        $request -> validate(['description' => 'required']);
        $user = Auth::user();

        $revision = Revision::where('id', $id)->first();
        $revision -> description = nl2br(e($request->get('description')));
        $revision -> save();

        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $userfolder_raw = explode('@', $user -> email);
                $userfolder = str_replace('.', '', $userfolder_raw[0]);

                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:2048',
                    'document.*' => 'required|file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:10245',
                ]);

                $extension = $request->file->extension();
                $request->file->storeAs('public/re/'.$userfolder, $request->file->hashName());

                $url = Storage::disk('revisionfiles')->url($userfolder.'/'.$request->file->hashName());

                $filesize = $request->file('file')->getSize();

                $document = new FileUpload([
                    'user_id' => $user->id,
                    'filename' => $request -> file -> getClientOriginalName(),
                    'filesize' => $filesize,
                    'url' => $url,
                ]);

                $document -> save();
                $document_id = $document->id;

                $connectfile = new RevisionFile([
                    'revision_id' => $id,
                    'file_upload_id' => $document_id
                ]);

                $connectfile -> save();
            }
        }

        return redirect()->back()->with('message', 'Uređena revizija');
    }

    public function destroy($id)
    {
        //
    }
}
