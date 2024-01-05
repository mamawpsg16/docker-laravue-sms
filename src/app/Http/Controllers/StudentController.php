<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Service\StudentService;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    private $service;
    public function __construct(){
            $this->service = new StudentService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::select('id','email','gender_id','id','first_name','middle_name','last_name','date_of_birth','phone_number_1','image')
        ->with(['gender:id,name','enrollments:student_id,school_year_id,status','enrollments.school_year:id,name', 'address:student_id,address'])
        ->get()
        ->toArray();
        
        return response(['students' => $students]);        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        
        // Retrieve the validated input data...
        $student = $this->service->store($request);

        return response(['status' => 200, 'student' => $student]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::select('id','email','gender_id','first_name','middle_name','last_name','date_of_birth','phone_number_1','phone_number_2','image')
        ->with([
            'gender:id,name',
            'enrollments:student_id,school_year_id',
            'enrollments.school_year:id,name',
            'address:student_id,address,land_mark,contact_person,phone_number',
            'guardians:guardian_type_id,first_name,middle_name,last_name,email,phone_number_1,phone_number_2',
            'guardians.guardian_type:id,name',
            'health_information:student_id,height,weight,blood_type,allergies,medications,emergency_contact_name,emergency_contact_phone,last_health_checkup'])
        ->findOrFail($id)
        ->toArray();

        return response(['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
