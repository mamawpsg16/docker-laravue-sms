<?php

namespace App\Http\Controllers;

use App\Models\GuardianType;
use Illuminate\Http\Request;

class GuardianTypeController extends Controller
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
    public function show(GuardianType $guardianType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GuardianType $guardianType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuardianType $guardianType)
    {
        //
    }

    public function getGuardianTypes(){
        $guardianTypes = GuardianType::select('name as label', 'id as value')->active()->get()->toArray();

        return response(['guardianTypes' => $guardianTypes]);
    }
}
