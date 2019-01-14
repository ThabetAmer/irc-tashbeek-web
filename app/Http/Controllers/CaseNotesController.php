<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Models\Note;

class CaseNotesController extends Controller
{

    public function index($caseType, $id)
    {
        $case = $this->getCaseModelOrFail($caseType);

        abort_unless(auth()->user()->hasPermissionTo("notes.{$caseType}"), 403);

        $record = $case->query()->where('id',$id)->firstOrFail();

        $results = $record->notes()->with('user')->latest()->paginate(5);

        return NoteResource::collection($results);
    }

    public function store($caseType, $id)
    {
        request()->validate([
            'note' => 'required|string|max:500'
        ]);

        $case = $this->getCaseModelOrFail($caseType);

        $record = $case->query()->where('id',$id)->firstOrFail();

        $note = $record->addNote([
            'note' => request('note'),
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Note has been created.',
            'note' => new NoteResource($note)
        ], 201);
    }

    protected function getCaseModelOrFail($caseType)
    {
        try{
            return get_case_type_model($caseType);
        }catch(\Throwable $e){
            abort(404, "Cannot find this case type" );
        }
    }

    public function star($caseType, $id, $noteId)
    {
        $case = $this->getCaseModelOrFail($caseType);

        $record = $case->query()->where('id',$id)->firstOrFail();

        $note = $record->notes()->find($noteId);

        if(!$note){
            abort(404);
        }

        $note->update([
            'is_starred' => !$note->is_starred
        ]);

        return response()->json([
            'message' => 'Note has been created.',
            'note' => new NoteResource($note)
        ], 200);
    }
}
