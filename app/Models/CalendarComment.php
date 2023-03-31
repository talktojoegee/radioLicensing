<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarComment extends Model
{
    use HasFactory;

    public function getCommentedBy(){
        return $this->belongsTo(User::class, 'note_by');
    }

    public function leaveANote(Request $request){
        $note = new CalendarComment();
        $note->calendar_id = $request->appointmentId;
        $note->note = $request->note;
        $note->note_by = Auth::user()->id;
        $note->save();
    }
}
