<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guardian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function guardians()
    {
        return $this->belongsToMany(Student::class, 'student_guardians', 'guardian_id', 'student_id');
    }
}
