<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
        'email',
        'phone',
        'image',
        'rating',
        'experience_years',
        'bio',
        'is_active',
    ];

    // 🧩 Relationships

    // A doctor has many weekly availability records
    public function availabilities()
    {
        return $this->hasMany(DoctorAvailability::class);
    }

    // A doctor has many generated slots
    public function slots()
    {
        return $this->hasMany(DoctorSlot::class);
    }

    // A doctor has many appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
