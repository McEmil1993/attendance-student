<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandleStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'student_id',
        'room_assign'
    ];

    // Relationship to User (Instructor)
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    // Relationship to Student
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    
}

