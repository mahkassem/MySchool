<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'major',
    ];

    // User one-to-one relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Student many-to-many relationship with Course
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
