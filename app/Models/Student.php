<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'nisn',
        'class_name',
        'school_name',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
