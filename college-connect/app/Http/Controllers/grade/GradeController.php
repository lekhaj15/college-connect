<?php

namespace App\Http\Controllers\grade;

use App\Http\Controllers\Controller;
use App\Models\grade\Grade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    //
    // URI:


    // SUM:
    public function getGradeIndex(Request $request, int $id): JsonResponse
    {

        $grade = Grade::where('id','=', $id )

            ->orderBy('id','DESC')

            ->paginate(15);

        return response()->json([
            'grade' => $grade,
        ], JsonResponse::HTTP_OK);
    }

    // SUM: get all the category details
    public function getGrade(Request $request, int $id): JsonResponse
    {
        $grade=GradeCategory::toBase()
            ->where('id','=', $id )
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'grade' => $grade,
        ], JsonResponse::HTTP_OK);
    }


    // URI:
    // SUM: store the category
    public function postGradeStore(Request $request): JsonResponse
    {
        $request->validate([
            'grade_name' => 'required|string|max:45',
        ]);
        $grade_name = $request->input('grade_name');

        $grade = Grade::create([
            'grade_name' => $grade_name,
        ]);
        return response()->json([
            'grade' => $grade,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI:
    // SUM: displays the category
    public function getGradeShow(Request $request,int $id): JsonResponse
    {

        $grade= Grade::where('id', '=',$id)
            ->first();

        return response()->json([
            'grade' => $grade,



        ], JsonResponse::HTTP_OK);
    }


    // URI:
    // SUM: update the category
    public function patchGradeUpdate(Request $request, $id): JsonResponse
    {

        $grade_name = $request->input('grade_name');
//
        $test=Grade::toBase()
            ->where([
                ['id','=',$id],
            ])

            ->update([
                'grade_name'=> $grade_name
            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI:
    // SUM: deletes the category data
    public function deleteGradeCategory(Request $request,int $id): JsonResponse
    {
        $grade = Grade::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
