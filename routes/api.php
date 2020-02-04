<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group(['prefix' => 'courses'], function($course){
//     $course->get('/', 'Api\CourseController@getAllCourses');
// });

// Route::group(['prefix' => 'levels'], function($level){
//     $level->get('/', 'Api\LevelController@getAllLevels');
// });

// Route::group(['prefix' => 'teachers'], function($level){
//     $level->get('/', 'Api\TeacherController@getAllTeachers');
// });

// BUKA API

Route::group(['namespace' => 'Api'], function ($api) {
    // Auth
    $api->group(['prefix' => 'auth', 'namespace' => 'Auth'], function($auth) {
        $auth->post('/login', 'AuthenticateController@authenticate')->name('login');
        $auth->post('/register', 'AuthenticateController@register')->name('register');
    });
    // Teachers
    $api->group(['prefix' => 'teachers', 'middleware' => 'jwt.auth'], function($teacher){
        $teacher->get('/', 'TeacherController@getAllTeachers')->name('teachers');
        $teacher->post('/', 'TeacherController@createNewTeacher')->name('teachers.create');
    });
    // Students
    $api->group(['prefix' => 'students', 'middleware' => 'jwt.auth'], function($student){
        $student->get('/', 'StudentController@getStudents')->name('students');
        $student->post('/', 'StudentController@addStudent')->name('students.create');
    });
    // Courses
    $api->group(['prefix' => 'courses', 'middleware' => 'jwt.auth'], function($course){
        $course->get('/', 'CourseController@getAllCourses')->name('courses');
    });
    // Level
    $api->group(['prefix' => 'levels', 'middleware' => 'jwt.auth'], function($level){
        $level->get('/', 'LevelController@getLevels')->name('levels');
        $level->post('/', 'LevelController@createNewLevel')->name('levels.create');
    });
});
