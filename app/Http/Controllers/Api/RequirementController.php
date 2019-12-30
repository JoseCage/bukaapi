<?php

namespace Buka\Http\Controllers\Api;

use Illuminate\Http\Request;
use Buka\Http\Controllers\Controller;
use Buka\Requirement;

class RequirementController extends Controller
{
    public function getRequirements()
    {
        $requirements = Requirement::paginate(30);

        return response()->json($requirements);
    }

    public function createNewRequirement(Request $request)
    {
        $requiment = new Requirement();
        $requiment->name = $request['name'];
        $requiment->description = $request['description'];
        $requiment->save();

        return response()->json([
            'status' => 200,
            'message' => 'Requiment Created succesfully!',
            'data' => $requiment
        ]);
    }
}
