<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'subject',
    ];

    // User one-to-one relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Teacher many-to-many relationship with Classroom
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }
}
