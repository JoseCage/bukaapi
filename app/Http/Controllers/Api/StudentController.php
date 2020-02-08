<?php

namespace Buka\Http\Controllers\Api;

use Illuminate\Http\Request;
use Buka\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Buka\Student;

class StudentController extends Controller
{
  /**
  * Get all Students from Buka courses
  *
  */
    public function getStudents(Request $request)
    {
      $students = Student::paginate($request->per_page);

      return response()->json($students);
    }
    
    public function addStudent(Request $request)
    {
        $messages = [
          'required' => 'O :attribute deve estar preenchido!',
          'min' => 'O :attribute precisa ter no miníno :min caracteres',
          'max' => 'O :attribute precisa ter no máximo :max caracteres',
          'unique' => 'O :attribute já existe nos nossos registos!',
          'email' => 'Por favor preencha um email válido!'
      ];

      $validation = Validator::make($request->all(), [
          'name' => 'required|string|min:2|max:60',
          'username' => 'string|min:2|max:60',
          'email' => 'required|email|unique:teachers|max:100',
          'phone' => 'string|unique:teachers|min:9|max:12'
      ], $messages);

      if ($validation->fails()) {

      Log::critical('Há erros de validação nos dados fornecidos');

          return response()->json(
              $validation->errors()
          );
      }

      $student = Student::create($request->all());

      return response()->json([
        'status' => 200,
        'message' => 'Student Created succesfully!',
        'data' => $student
    ]);
    }
}
