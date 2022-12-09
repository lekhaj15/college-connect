<?php

namespace App\Http\Controllers\grade;

use App\Http\Controllers\Controller;
use App\Models\subject\LanguageCombination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LanguageCombinationController extends Controller
{
    //
    // URI:


    // SUM:
    public function getLanguageIndex(Request $request, int $id): JsonResponse
    {

        $language = LanguageCombination::where('id','=', $id )

            ->orderBy('id','DESC')

            ->paginate(15);

        return response()->json([
            'language' => $language,
        ], JsonResponse::HTTP_OK);
    }

    // SUM: get all the category details
    public function getLanguage(Request $request, int $id): JsonResponse
    {
        $language =LanguageCombination::toBase()
            ->where('id','=', $id )
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'language' => $language,
        ], JsonResponse::HTTP_OK);
    }


    // URI:
    // SUM: store the category
    public function postLanguageStore(Request $request): JsonResponse
    {
        $language1 = $request->input('language1');
        $language2 = $request->input('language2');

        $language = LanguageCombination::create([
            'language1' => $language1,
            'language2' => $language2,
        ]);
        return response()->json([
            'language' => $language,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI:
    // SUM: displays the category
    public function getLanguageShow(Request $request,int $id): JsonResponse
    {

        $language= LanguageCombination::where('id', '=',$id)
            ->first();

        return response()->json([
            'language' => $language,



        ], JsonResponse::HTTP_OK);
    }


    // URI:
    // SUM: update the category
    public function patchLanguageUpdate(Request $request, $id): JsonResponse
    {

        $language1 = $request->input('language1');
        $language2 = $request->input('language2');//
        $test=LanguageCombination::toBase()
            ->where([
                ['id','=',$id],
            ])

            ->update([
                'language1' => $language1,
                'language2' => $language2,            ]);

        return response()->json([
            'success' => 'update success'  ,
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI:
    // SUM: deletes the category data
    public function deleteLanguage(Request $request,int $id): JsonResponse
    {
        $language = LanguageCombination::where('id','=',$id)
            ->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
