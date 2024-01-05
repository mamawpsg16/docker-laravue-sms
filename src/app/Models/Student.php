<?php

namespace App\Models;

use App\Models\Gender;
use App\Models\Address;
use App\Models\Guardian;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentHealthInformation;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';

    protected $guarded = ['id'];

    protected $appends = ['student_image'];

     /**
     * Get the guardians of the student.
     */
    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'student_guardians', 'student_id', 'guardian_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function health_information()
    {
        return $this->hasOne(StudentHealthInformation::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'id');
    }

    // public function getStudentImageAttribute()
    // {
    //     $image = url('storage/default_images/profile.png');

    //     if(isset($this->attributes['image'])){
    //         $image  = url('storage/student_images/'.$this->attributes['image']);
    //     }

    //     return $image;
    // }

    protected function studentImage(): Attribute
    {
        $asset =  $this->image ? "/student_images/".$this->image : "/default_images/profile.png";
        return new Attribute(
            get: fn () => asset("storage".$asset),
        );
    }
}
