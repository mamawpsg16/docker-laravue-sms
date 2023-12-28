<?php
namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudentRegistration;

class StudentRegistrationService{
    public function __construct(){

    }
    /**
     * @param Request $request
     * @return void
     */

    public function store($data){
        DB::transaction(function () use($data){
            dd($data);
            $student = StudentRegistration::create([
                ''
            ]);

           $student->guardians()->createMany([
                ['message' => 'A new comment.'],
                ['message' => 'Another new comment.'],
            ]);

            $student->address()->create([
                ''
            ]);

            $student->health_information()->create(
                ['message' => 'A new comment.']
            );
            
        });
    }
}