<?php

namespace App\Http\Controllers\grade;

use App\Http\Controllers\Controller;
use App\Models\grade\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SectionController extends Controller
{
    //
    // URI:
    // SUM: get all the subcategory details
    public function getSectionIndex(Request $request, int $id): JsonResponse
    {
        $section = Section::with(['gradeInformation'])


            ->orderBy('grade_id')
            ->paginate(15);

        return response()->json([
            'section' => $section,
        ], JsonResponse::HTTP_OK);
    }

    // URI:
    // SUM:
    public function postSectionStore(Request $request): JsonResponse
    {
        $request->validate([
            'section_name' => 'required|string|max:45',

        ]);
        $grade_id = $request->input('grade_id');
        $section_name = $request->input('section_name');


        $section  = Section::create([
            'grade_id' => $grade_id,
            'section_name' => $section_name,
        ]);
        return response()->json([
            'section' => $section,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI:
    // SUM:display the values
    public function getSectionShow( Request $request,int $id): JsonResponse
    {
        $section = Section::where('id','=',$id)
            ->first();

        return response()->json([
            'section'=>$section,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/subcategory/category_id
    // SUM:display the values
    public function getSection( Request $request,int $grade_id): JsonResponse
    {
        $section = Section::where('grade_id','=',$grade_id)
            ->get();

        return response()->json([
            'section'=>$section,
        ], JsonResponse::HTTP_OK);
    }


    // URI: /api/institute/subcategory
    // SUM:
    public function patchSectionUpdate(Request $request,int $id): JsonResponse
    {

//        dd( $id);
        $grade_id=$request->input('grade_id');

        $section_name = $request->input('section_name');
//        dd($category_name);
        $test=Section::toBase()
            ->where(
                'id','=',$id
            )

            ->update([
                'section_name'=> $section_name,
                'grade_id'=>$grade_id,
            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], Response::HTTP_ACCEPTED);
    }

    // URI: /api/institute/subcategory/delete
    // SUM: delete subcategory data
    public function deleteSection(Request $request,int $id): JsonResponse
    {

        $subcategory= Section::where('id', '=', $id)

            ->delete();

        return response()->json([
            'success' => 'delete success',
        ], Response::HTTP_NO_CONTENT);
    }
}
