<?php

namespace App\Http\Controllers\grade;

use App\Http\Controllers\Controller;
use App\Models\subject\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubjectController extends Controller
{
    //
    // URI:


    // SUM:
    public function getSubjectIndex(Request $request, int $id): JsonResponse
    {

        $subject = Subject::where('id','=', $id )

            ->orderBy('id','DESC')

            ->paginate(15);

        return response()->json([
            'subject' => $subject,
        ], Response::HTTP_OK);
    }

    // SUM: get all the category details
    public function getSubject(Request $request, int $id): JsonResponse
    {
        $subject=Subject::toBase()
            ->where('id','=', $id )
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'subject' => $subject,
        ], Response::HTTP_OK);
    }


    // URI:
    // SUM: store the category
    public function postSubjectStore(Request $request): JsonResponse
    {
        $request->validate([
            'subject_name' => 'required|string|max:45',
        ]);
        $subject_name = $request->input('subject_name');

        $subject = Subject::create([
            'subject_name' => $subject_name,
        ]);
        return response()->json([
            'subject' => $subject,
        ], Response::HTTP_CREATED);
    }

    // URI:
    // SUM: displays the category
    public function getSubjectShow(Request $request,int $id): JsonResponse
    {

        $subject= Subject::where('id', '=',$id)
            ->first();

        return response()->json([
            'subject' => $subject,



        ], Response::HTTP_OK);
    }


    // URI:
    // SUM: update the category
    public function patchSubjectUpdate(Request $request, $id): JsonResponse
    {

        $subject_name = $request->input('subject_name');
//
        $test=Subject::toBase()
            ->where([
                ['id','=',$id],
            ])

            ->update([
                'subject_name'=> $subject_name
            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], Response::HTTP_ACCEPTED);
    }

    // URI:
    // SUM: deletes the category data
    public function deleteGradeCategory(Request $request,int $id): JsonResponse
    {
        $subject = Subject::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], Response::HTTP_NO_CONTENT);
    }
}
