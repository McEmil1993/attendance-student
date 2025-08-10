<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEnroll extends Model
{
    use HasFactory;

    protected $table = 'student_enrolls';

    protected $fillable = [
        'student_id',
        'term_id',
        'assessment_id',
        'instructor_id',
        'score',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
