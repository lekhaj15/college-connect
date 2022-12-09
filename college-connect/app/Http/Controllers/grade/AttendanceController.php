<?php

namespace App\Http\Controllers\grade;

use App\Http\Controllers\Controller;
use App\Models\grade\Attendance;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Symfony\Component\HttpFoundation\Response;

class AttendanceController extends Controller
{
    //
    // URI:
    // SUM: get all the subcategory details
    public function getAttendanceIndex(Request $request, int $id): JsonResponse
    {
        $attendance = Attendance::with(['gradeInformation','sectionInformation','subjectInformation','staffInformation','studentInformation'])


            ->orderBy('id')
            ->paginate(15);

        return response()->json([
            'attendance' => $attendance,
        ], JsonResponse::HTTP_OK);
    }

    // URI:
    // SUM:
    public function postAttendanceStore(Request $request): JsonResponse
    {

        $grade_id = $request->input('grade_id');
        $section_id = $request->input('section_id');
        $subject_id = $request->input('subject_id');
        $staff_id = $request->input('staff_id');
        $student_id = $request->input('student_id');
        $attendance = $request->input('attendance');



        $attendance1  = Attendance::create([
            'grade_id' => $grade_id,
            'section_id' => $section_id,
            'subject_id' => $subject_id,
            'staff_id' => $staff_id,
            'student_id' => $student_id,
            'attendance' => $attendance,
        ]);
        return response()->json([
            'attendance' => $attendance1,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI:
    // SUM:display the values
    public function getAttendanceShow( Request $request,int $id): JsonResponse
    {
        $attendance = Attendance::where('id','=',$id)
            ->first();

        return response()->json([
            'attendance'=>$attendance,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/subcategory/category_id
    // SUM:display the values
    public function getAttendance( Request $request,int $student_id): JsonResponse
    {
        $attendance = Attendance::where('student_id','=',$student_id)
            ->get();

        return response()->json([
            'attendance'=>$attendance,
        ], JsonResponse::HTTP_OK);
    }


    // URI: /api/institute/subcategory
    // SUM:
    public function patchAttendanceUpdate(Request $request,int $id): JsonResponse
    {

//        dd( $id);
        $grade_id=$request->input('grade_id');
        $section_id = $request->input('section_id');
        $subject_id = $request->input('subject_id');
        $staff_id = $request->input('staff_id');
        $student_id = $request->input('student_id');
        $attendance = $request->input('attendance');


        $test=Attendance::toBase()
            ->where(
                'id','=',$id
            )

            ->update([

                'grade_id' => $grade_id,
                'section_id' => $section_id,
                'subject_id' => $subject_id,
                'staff_id' => $staff_id,
                'student_id' => $student_id,
                'attendance' => $attendance,
            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], Response::HTTP_ACCEPTED);
    }

    // URI: /api/institute/subcategory/delete
    // SUM: delete subcategory data
    public function deleteAttendance(Request $request,int $id): JsonResponse
    {

        $attendance = Attendance::where('id', '=', $id)

            ->delete();

        return response()->json([
            'success' => 'delete success',
        ], Response::HTTP_NO_CONTENT);
    }

}
