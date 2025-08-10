<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnroll::class);
    }
}
