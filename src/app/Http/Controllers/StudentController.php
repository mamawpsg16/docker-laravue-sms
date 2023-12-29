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
        $students = Student::get()->toArray();
        return response(['students' => $students]);        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        // Retrieve the validated input data...
        $data = $request->validated();

        $student = $this->service->store($data);
        dd($student);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
