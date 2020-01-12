<?php

namespace Buka\Http\Controllers\Api;

use App\Services\WeSenderService;
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

    public function addNewCourse(Request $request)
    {

        $course = new Course();
        $course->name = $request['name'];
        $course->short_description = $request['short_description'];
        $course->description = $request['description'];
        $course->price = $request['price'];
        $course->course_time = $request['course_time'];
        $course->start_at = $request['start_at'];
        $course->end_at = $request['end_at'];
        $course->teacher_id = $request['teacher_id'];
        $course->schedule = $request['schedule'];
        $course->link = $request['link'];
        $course->level_id = $request['level_id'];
        $course->save();

        // Send a SMS to the teacher
        WeSenderService::send($course->teacher->phone, 'Seu novo curso foi cadastrado!', false);

        return response()->json([
            'status_code' => 201,
            'message' => 'Course created successfuly!',
            'data' => $course
        ]);
    }
}
