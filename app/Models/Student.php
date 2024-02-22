<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function aspiration()
    {
        return $this->hasMany(Aspiration::class);
    }

    public function student_class()
    {
        return $this->belongsTo(StudentClass::class);
    }
}
