<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Guardian;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentHealthInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';

    protected $guarded = ['id'];

     /**
     * Get the guardians of the student.
     */
    public function guardians()
    {
        return $this->hasMany(Guardian::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function health_information()
    {
        return $this->hasOne(StudentHealthInformation::class);
    }

}
