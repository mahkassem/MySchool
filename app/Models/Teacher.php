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

    // Teacher one-to-many relationship with Course
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
