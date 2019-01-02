<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaseNotesController extends Controller
{


    public function store($caseType, $id)
    {
        request()->validate([
            'note' => 'required|string|max:500'
        ]);

        try{
            $case = get_case_type_model($caseType);
        }catch(\Throwable $e){
            abort(404, "Cannot find this case type" );
        }

        $record = $case->query()->where('id',$id)->firstOrFail();

        $record->addNote([
            'note' => request('note'),
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Create',
        ], 201);
    }
}
