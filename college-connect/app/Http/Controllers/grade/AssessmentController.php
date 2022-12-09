<?php

namespace App\Http\Controllers\grade;

use App\Http\Controllers\Controller;
use App\Models\grade\Assesment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssessmentController extends Controller
{
    //
    // URI:
    // SUM: get all the subcategory details
    public function getAssesmentIndex(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $assessment = Assesment::with(['gradeInformation','sectionInformation','subjectInformation','staffInformation','studentInformation'])


            ->orderBy('id')
            ->paginate(15);

        return response()->json([
            'assessment' => $assessment,
        ], JsonResponse::HTTP_OK);
    }

    // URI:
    // SUM:
    public function postAssesmentStore(Request $request): JsonResponse
    {

        $grade_id = $request->input('grade_id');
        $section_id = $request->input('section_id');
        $subject_id = $request->input('subject_id');
        $staff_id = $request->input('staff_id');
        $student_id = $request->input('student_id');
        $assessment_name = $request->input('assessment_name');
        $marks = $request->input('marks');



        $assessment  = Assesment::create([
            'grade_id' => $grade_id,
            'section_id' => $section_id,
            'subject_id' => $subject_id,
            'staff_id' => $staff_id,
            'student_id' => $student_id,
            'assessment_name' => $assessment_name,
            'marks' => $marks,
        ]);
        return response()->json([
            'assessment' => $assessment,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI:
    // SUM:display the values
    public function getAssesmentShow( Request $request,int $id): JsonResponse
    {
        $assessment = Assesment::where('id','=',$id)
            ->first();

        return response()->json([
            'assessment'=>$assessment,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/subcategory/category_id
    // SUM:display the values
    public function getAssesment( Request $request,int $student_id): JsonResponse
    {
        $assessment = Assesment::where('student_id','=',$student_id)
            ->get();

        return response()->json([
            'assessment'=>$assessment,
        ], JsonResponse::HTTP_OK);
    }


    // URI: /api/institute/subcategory
    // SUM:
    public function patchAssesmentUpdate(Request $request,int $id): JsonResponse
    {

//        dd( $id);
        $grade_id=$request->input('grade_id');
        $section_id = $request->input('section_id');
        $subject_id = $request->input('subject_id');
        $staff_id = $request->input('staff_id');
        $student_id = $request->input('student_id');
        $assessment_name = $request->input('assessment_name');
        $marks = $request->input('marks');

        $test=Assesment::toBase()
            ->where(
                'id','=',$id
            )

            ->update([

                'grade_id' => $grade_id,
                'section_id' => $section_id,
                'subject_id' => $subject_id,
                'staff_id' => $staff_id,
                'student_id' => $student_id,
                'assessment_name' => $assessment_name,
                'marks' => $marks,            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], Response::HTTP_ACCEPTED);
    }

    // URI: /api/institute/subcategory/delete
    // SUM: delete subcategory data
    public function deleteAssesment(Request $request,int $id): JsonResponse
    {

        $assessment = Assesment::where('id', '=', $id)

            ->delete();

        return response()->json([
            'success' => 'delete success',
        ], Response::HTTP_NO_CONTENT);
    }

}
