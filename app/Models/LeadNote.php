<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadNote extends Model
{
    use HasFactory;

    public function getAddedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }

    public function addNote(Request $request){
        $note = new LeadNote();
        $note->org_id = Auth::user()->org_id;
        $note->added_by = Auth::user()->id;
        $note->lead_id = $request->leadId;
        $note->note = $request->addNote;
        $note->save();
    }

       public function editNote(Request $request){
        $note =  LeadNote::find($request->noteId);
        $note->lead_id = $request->leadId;
        $note->note = $request->addNote;
        $note->save();
    }


    public function deleteNote($noteId){
        $note = LeadNote::find($noteId);
        $note->delete();
    }

    public function getAllOrgNotes(){
         return LeadNote::where('org_id', Auth::user()->org_id)->orderBy('id', 'DESC')->get();
    }
}
