<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'firstname',
        'middle_initial',
        'lastname',
        'gender',
        'address',
        'student_profile_path',
        'course',
        'year',
        'block'
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnroll::class);
    }
}
