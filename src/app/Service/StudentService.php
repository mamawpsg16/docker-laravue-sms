<?php
namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class StudentService{
    public function __construct(){

    }
    /**
     * @param Request $request
     * @return void
     */

    public function store($data){
        DB::transaction(function () use($data){
            $student = Student::create($data['student_information']);
            $student_id = $student['id'];
            $student->enrollments()->create([
                'student_id' =>$student_id,
                'school_year_id' => $data['student_information']['school_year_id'],
            ]);
            $guardians = array_map(function ($item) use($student_id){
                return array_merge($item, ['student_id' => $student_id]);
            }, $data['guardians']);

            dd($guardians);

            $student->address()->create($data['student_information']);

            $student->health_information()->create($data['health_information']);

            return $student;
        });
    }
}