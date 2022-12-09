<?php

namespace App\Http\Controllers\grade;

use App\Http\Controllers\Controller;
use App\Models\subject\SubjectCombination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubjectCombinationController extends Controller
{
    //
    // URI:
    // SUM: get all the subcategory details
    public function getSubjectCombinationIndex(Request $request, int $id): JsonResponse
    {
        $subjectcombination = SubjectCombination::with(['subjectInformation'])


            ->orderBy('subject_id')
            ->paginate(15);

        return response()->json([
            'subjectcombination' => $subjectcombination,
        ], JsonResponse::HTTP_OK);
    }

    // URI:
    // SUM:
    public function postSubjectCombinationStore(Request $request): JsonResponse
    {



        $subject1_id = $request->input('subject1_id');
        $subject2_id = $request->input('subject2_id');
        $subject3_id = $request->input('subject3_id');
        $subject4_id = $request->input('subject4_id');

        $subjectcombination  = SubjectCombination::create([
            'subject1_id' => $subject1_id,
            'subject2_id' => $subject2_id,
            'subject3_id' => $subject3_id,
            'subject4_id' => $subject4_id,
        ]);
        return response()->json([
            'subjectcombination' => $subjectcombination,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI:
    // SUM:display the values
    public function getSubjectCombinationShow( Request $request,int $id): JsonResponse
    {
        $subjectcombination = SubjectCombination::where('id','=',$id)
            ->first();

        return response()->json([
            'subjectcombination'=>$subjectcombination,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/subcategory/category_id
    // SUM:display the values
    public function getSubjectCombination( Request $request,int $subject_id): JsonResponse
    {
        $subjectcombination = SubjectCombination::where('subject_id','=',$subject_id)
            ->get();

        return response()->json([
            'subjectcombination'=>$subjectcombination,
        ], JsonResponse::HTTP_OK);
    }


    // URI: /api/institute/subcategory
    // SUM:
    public function patchSubjectCombinationUpdate(Request $request,int $id): JsonResponse
    {


        $subject1_id = $request->input('subject1_id');
        $subject2_id = $request->input('subject2_id');
        $subject3_id = $request->input('subject3_id');
        $subject4_id = $request->input('subject4_id');
        $test=SubjectCombination::toBase()
            ->where(
                'id','=',$id
            )

            ->update([
                'subject1_id' => $subject1_id,
                'subject2_id' => $subject2_id,
                'subject3_id' => $subject3_id,
                'subject4_id' => $subject4_id,
            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /api/institute/subcategory/delete
    // SUM: delete subcategory data
    public function deleteSubjectCombination(Request $request,int $id): JsonResponse
    {

        $subjectcombination= SubjectCombination::where('id', '=', $id)

            ->delete();

        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
