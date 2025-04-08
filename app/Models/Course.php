<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = [
        'name',
        'course_id',
        'semester',
        'status_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
