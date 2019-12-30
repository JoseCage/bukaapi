<?php

namespace Buka\Http\Controllers\Api;

use Illuminate\Http\Request;
use Buka\Http\Controllers\Controller;
use Buka\Topic;

class TopicController extends Controller
{
    public function getTopics()
    {
        $Topics = Topic::paginate(30);

        return response()->json($Topics);
    }

    public function createNewTopic(Request $request)
    {
        $Topic = new Topic();
        $Topic->name = $request['name'];
        $Topic->description = $request['description'];
        $Topic->save();

        return response()->json([
            'status' => 200,
            'message' => 'Topic Created succesfully!',
            'data' => $Topic
        ]);
    }
}
