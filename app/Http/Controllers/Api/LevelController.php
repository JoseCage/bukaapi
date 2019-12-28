<?php

namespace Buka\Http\Controllers\Api;

use Illuminate\Http\Request;
use Buka\Http\Controllers\Controller;
use Buka\Level;

class LevelController extends Controller
{
    public function getLevels()
    {
        $levels = Level::paginate(30);

        return response()->json($levels);
    }

    public function createNewLevel(Request $request)
    {
        $level = new Level();
        $level->name = $request['name'];
        $level->description = $request['description'];
        $level->save();

        return response()->json([
            'status' => 200,
            'message' => 'Level Created succesfully!',
            'data' => $level
        ]);
    }
}
