<?php

namespace Buka\Http\Controllers\Api;

use Illuminate\Http\Request;
use Buka\Http\Controllers\Controller;
use Buka\Teacher;

class TeacherController extends Controller
{
    public function getAllTeachers(Request $request)
    {
        $teachers = Teacher::paginate($request->per_page);

        return response()->json($teachers);
    }

    public function createNewTeacher(Request $request)
    {
        $teacher = new Teacher();
        $teacher->first_name = $request['first_name'];
        $teacher->last_name = $request['last_name'];
        $teacher->email = $request['email'];
        $teacher->phone = $request['phone'];
        $teacher->save();

        return response()->json([
            'status' => 200,
            'message' => 'Teacher Created succesfully!',
            'data' => $teacher
        ]);
    }
}
