<?php

namespace Buka\Http\Controllers\Api;

use Illuminate\Http\Request;
use Buka\Http\Controllers\Controller;
use Buka\Target;

class TargetController extends Controller
{
    public function getTargets()
    {
        $targets = Level::paginate(30);

        return response()->json($targets);
    }

    public function createNewTarget(Request $request)
    {
        $target = new Target();
        $target->name = $request['name'];
        $target->description = $request['description'];
        $target->save();

        return response()->json([
            'status' => 200,
            'message' => 'Target Created succesfully!',
            'data' => $target
        ]);
    }
}
