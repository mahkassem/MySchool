<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'building_id',
    ];

    // Building one-to-many relationship
    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
