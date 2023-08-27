<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'teacher_id',
    ];

    // Classroom many-to-many relationship with Student
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    // Classroom many-to-one relationship with Teacher
    public function teachers()
    {
        return $this->belongsTo(Teacher::class);
    }
}
