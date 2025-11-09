<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'slot_id',
        'first_name',
        'last_name',
        'age',
        'email',
        'mobile',
        'address',
        'service',
        'branch',
        'message',
        'status',
    ];

    // 🧩 Relationships

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function slot()
    {
        return $this->belongsTo(DoctorSlot::class, 'slot_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
