<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Gender $guardianType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gender $guardianType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gender $guardianType)
    {
        //
    }

    public function getGenders(){
        $genders = Gender::select('name as label', 'id as value')->active()->get()->toArray();

        return response(['genders' => $genders]);
    }
}
