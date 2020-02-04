<?php

namespace Buka\Http\Controllers\Api;

use Illuminate\Http\Request;
use Buka\Http\Controllers\Controller;
use Buka\Teacher;
use Buka\Services\WeSenderService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function getAllTeachers(Request $request)
    {
        $teachers = Teacher::with('courses')->paginate($request->per_page);

        return response()->json($teachers);
    }

    public function createNewTeacher(Request $request)
    {
        $messages = [
            'required' => 'O :attribute deve estar preenchido!',
            'min' => 'O :attribute precisa ter no miníno :min caracteres',
            'max' => 'O :attribute precisa ter no máximo :max caracteres',
            'unique' => 'O :attribute já existe nos nossos registos!',
            'email' => 'Por favor preencha um email válido!'
        ];

        $validation = Validator::make($request->all(), [
            'first_name' => 'required|string|min:2|max:60',
            'last_name' => 'required|string|min:2|max:60',
            'email' => 'required|email|unique:teachers|max:100',
            'phone' => 'string|unique:teachers|min:9|max:12'
        ], $messages);

        if ($validation->fails()) {

         Log::critical('Há erros de validação nos dados fornecidos');

            return response()->json(
                $validation->errors()
            );
        }

        $teacher = new Teacher();
        $teacher->first_name = $request['first_name'];
        $teacher->last_name = $request['last_name'];
        $teacher->email = $request['email'];
        $teacher->phone = $request['phone'];
        $teacher->save();

        Log::info('Foi cadastrado um novo professor');

        // if ($teacher) {
             // Send a SMS to the teacher
        //     WeSenderService::send([$teacher->phone], 'Parabéns, ' . $teacher->first_name . ' ' . $teacher->last_name . ' por se cadastrar como professor no Buka App');
        // }

        return response()->json([
            'status' => 200,
            'message' => 'Teacher Created succesfully!',
            'data' => $teacher
        ]);
    }
}
