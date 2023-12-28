<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Guardian;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentHealthInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentRegistration extends Model
{
    use HasFactory;
    protected $table = 'students';


     /**
     * Get the guardians of the student.
     */
    public function guardians()
    {
        return $this->hasMany(Guardian::class,'student_id');
    }

    public function address()
    {
        return $this->hasMany(Address::class,'student_id');
    }

    public function health_information()
    {
        return $this->hasOne(StudentHealthInformation::class,'student_id');
    }

}
