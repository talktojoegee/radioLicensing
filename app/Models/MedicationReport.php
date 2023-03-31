<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicationReport extends Model
{
    use HasFactory;

    public function getReportedBy(){
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function addMedicationReport(Request $request){
        $report = new MedicationReport();
        $report->medication_id = $request->medicationId;
        $report->reported_by = Auth::user()->id;
        $report->report = $request->report;
        $report->save();
    }
}
