<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;

class CaseNotesController extends Controller
{

    public function index($caseType, $id)
    {
        $case = $this->getCaseModelOrFail($caseType);

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
}
