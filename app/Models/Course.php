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
        'classroom_id'
    ];

    // Classroom many-to-many relationship with Student
    public function students()
    {
        return $this->belongsToMany(Student::class, CourseStudent::class);
    }

    // Classroom many-to-one relationship with Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Classroom many-to-one relationship with Classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // Scope for searching by teacher name
    public function scopeSearchByTeacherName($query, $teacherName)
    {
        return $query->whereHas('teacher', function ($query) use ($teacherName) {
            $query->where('first_name', 'like', '%' . $teacherName . '%')
                ->orWhere('last_name', 'like', '%' . $teacherName . '%');
        });
    }
}
