<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentConsultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'treatment_id',
        'preferred_date',
        'contact_number',
        'email',
        'message',
        'status',
    ];

    /**
     * Relationship: Each consultation belongs to a treatment
     */
    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }

    /**
     * Accessor to show readable status text
     */
    public function getStatusTextAttribute()
    {
        return $this->status ? 'Contacted' : 'Pending';
    }
}
