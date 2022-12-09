<?php

namespace App\Http\Controllers\grade;

use App\Http\Controllers\Controller;
use App\Models\student\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    //
    // URI: /student/index
    // SUM: get all the student information details
    public function getStudentIndex(Request $request, int $id): JsonResponse
    {

        $student = Student::with(['gradeInformation','sectionInformation'])
            ->where('id','=', $id )
            ->paginate(15);

        return response()->json([
            'student' => $student,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/student/store
    // SUM:
    public function postStudentStore(Request $request): JsonResponse
    {


        $student_id = $request->input('student_id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $grade_id = $request->input('grade_id');
        $section_id= $request->input('section_id');
        $student_email = $request->input('student_email');
        $student_password = $request->input('student_password');
        $student_phone = $request->input('student_phone');
        $combination_id = $request->input('combination_id');
        $student_dob = $request->input('student_dob');

        $language_id = $request->input('language_id');


        $student = Student::create([


            'student_id'=> $student_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'grade_id'=> $grade_id,
            'section_id'=> $section_id,
            'student_email'=> $student_email,
            'student_password'=> Hash::make('student'),
            'student_phone'=> $student_phone,
            'combination_id'=> $combination_id,
            'language_id'=> $language_id,
            'student_dob' => $student_dob

        ]);

        return response()->json([
            'student' => $student,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /student/information
    // SUM:display of student information
    public function getStudentShow( Request $request, $id,): JsonResponse
    {

        $student=Student::with(['gradeInformation','sectionInformation'])
            ->where('id','=',$id)
            ->first();
        return response()->json([
            'student' =>$student,
        ], JsonResponse::HTTP_OK);
    }


    // URI: /student/update
    // SUM:update student information
    public function patchStudentUpdate(Request $request,int $id): JsonResponse
    {

        $student_id = $request->input('student_id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $grade_id = $request->input('grade_id');
        $section_id= $request->input('section_id');
        $student_email = $request->input('student_email');
        $student_phone = $request->input('student_phone');
        $combination_id = $request->input('combination_id');
        $language_id = $request->input('language_id');
        $student_dob = $request->input('student_dob');



        Student::toBase()
            ->where('id' ,'=', $id)
            ->update([            'student_id'=> $student_id,

                'first_name' => $first_name,
                'last_name' => $last_name,
                'grade_id'=> $grade_id,
                'section_id'=> $section_id,
                'student_email'=> $student_email,
                'student_phone'=> $student_phone,
                'combination_id'=> $combination_id,
                'student_dob' => $student_dob,

                'language_id'=> $language_id,]);



        return response()->json([
            'update' => 'success',
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /api/student/delete
    // SUM:delete student data
    public function deleteStudentInformation(Request $request,int $id): JsonResponse
    {
        $student= Student::where('id','=',$id)->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
