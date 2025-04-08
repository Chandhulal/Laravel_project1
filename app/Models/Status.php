<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $fillable = [
        'active',
        'inactive',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
