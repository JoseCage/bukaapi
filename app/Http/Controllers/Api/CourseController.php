<?php

namespace Buka\Http\Controllers\Api;

use Buka\Course;
use Illuminate\Http\Request;
use Buka\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function getAllCourses()
    {
        $courses = Course::paginate(30);

        return response()->json($courses);
    }

    public function addNewCourse()
    {
        //
    }
}
