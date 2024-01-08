<?php
namespace App\Service;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

            $student->health_information()->create($data['health_information']);

            $student->address()->create($data['address_information']);

            return $student;
        });
    }

    public function update($request){
        return DB::transaction(function () use($request){
            $data = $request->validated();
            
            $student = Student::findOrFail($data['student_information']['id']);
            
            $file = $request->file('image');
            if($file){
                if($student->image){
                    $asset =  "storage/student_images/".$student->image;
               
                    Storage::disk('public')->delete($asset);
                }
                $file_name = $file->hashName();
                 
                $file->storeAs('student_images', $file_name, 'public');
     
                $student->image = $file_name;
     
                $student->save();
            }
 
            
            $student->enrollments()->where('school_year_id', $data['student_information']['school_year_id'])
            ->update([
                'school_year_id' => $data['student_information']['school_year_id'],
            ]);

            //DELETE ALL RELATED GUARDIANS
            $student->guardians()->detach();
            $student->guardians()->delete();

            /** 
             * * PIVOT TABLE WILL BE AUTOMATICALLY FILLED USING CREATE MANY NO NEED FOR ATTACH OR SYNC
            */

            $student->guardians()->createMany($data['guardians']);

            $student->health_information()->update($data['health_information']);

            $student->address()->update($data['address_information']);

            $student->update($data['student_information']);

            //GET ALL NECESSARY DETAILS
            $updatedStudent = Student::select('id','email','gender_id','first_name','middle_name','last_name','date_of_birth','phone_number_1','phone_number_2','image')
            ->with([
                'gender:id,name',
                'enrollments:student_id,school_year_id',
                'enrollments.school_year:id,name',
                'address:student_id,address,landmark,contact_person,phone_number',
                'guardians:guardian_type_id,first_name,middle_name,last_name,email,phone_number_1,phone_number_2',
                'guardians.guardian_type' => function($query){
                    $query->select(['id', 'name as label', 'id as value']);
                },
                'health_information:student_id,height,weight,blood_type,allergies,medications,emergency_contact_name,emergency_contact_phone,last_health_checkup'
            ])
            ->findOrFail($student->id)
            ->toArray();
            
            return $updatedStudent;
         });
     }


     public function destroy($student){
        return DB::transaction(function () use($student){
            if($student->image){
               $asset =  "storage/student_images/".$student->image;
           
               Storage::disk('public')->delete($asset);
           }
       
           $student->guardians()->detach();
           $student->enrollments()->delete();
           $student->guardians()->delete();
           $student->health_information()->delete();
           $student->address()->delete();
           $student->guardians()->delete();
           $student->delete();
           return $student;
        });
     }
}