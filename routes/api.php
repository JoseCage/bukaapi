<?php

use Illuminate\Http\Request;

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

// BUKA API

Route::group(['namespace' => 'Api'], function ($api) {
    // Auth
    $api->group(['prefix' => 'auth', 'namespace' => 'Auth'], function($auth) {
        $auth->post('/login', 'AuthenticateController@authenticate');
        $auth->post('/register', 'AuthenticateController@register');
    });
    // Teachers
    $api->group(['prefix' => 'teachers'], function($teacher){
        $teacher->get('/', 'TeacherController@getAllTeachers')->name('teachers');
        $teacher->post('/', 'TeacherController@createNewTeacher')->name('teachers.create');
    });
    // Courses
    $api->group(['prefix' => 'courses'], function($course){
        $course->get('/', 'CourseController@getAllCourses')->name('courses');
    });
    // Level
    $api->group(['prefix' => 'levels'], function($course){
        $course->get('/', 'LevelController@getLevels')->name('levels');
        $course->post('/', 'LevelController@createNewLevel')->name('levels.create');
    });
});
