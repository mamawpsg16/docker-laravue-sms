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

    public function store($request){
       return DB::transaction(function () use($request){
            $data = $request->validated();

            $student = Student::create($data['student_information']);
            $file = $request->file('image');
            if($file){
                $file_name = $file->hashName();
                
                $file->storeAs('student_images', $file_name, 'public');
    
                $student->image = $file_name;
    
                $student->save();
            }

            $student->enrollments()->create([
                'student_id' => $student['id'],
                'school_year_id' => $data['student_information']['school_year_id'],
            ]);

            /** 
             * * PIVOT TABLE WILL BE AUTOMATICALLY FILLED USING CREATE MANY NO NEED FOR ATTACH OR SYNC
            */
            $student->guardians()->createMany($data['guardians']);
            
            $student->address()->create($data['student_information']);

            $student->health_information()->create($data['health_information']);

            $student->address()->create($data['address_information']);

            return $student;
        });
    }
}