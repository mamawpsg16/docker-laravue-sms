<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentRegistration;
use App\Service\StudentRegistrationService;
use App\Http\Requests\StudentRegistrationRequest;

class StudentRegistrationController extends Controller
{
    private $service;
    public function __construct(){
            $this->service = new StudentRegistrationService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = StudentRegistration::get()->toArray();
        return response(['students' => $students]);        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRegistrationRequest $request)
    {
        // Retrieve the validated input data...
        $data = $request->validated();

        $this->service->store($data);
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
