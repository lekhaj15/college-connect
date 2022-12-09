<?php

namespace App\Http\Controllers\grade;

use App\Http\Controllers\Controller;
use App\Models\staff\Staff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class StaffController extends Controller
{
    //
// URI: /institute/staff/index
    // SUM: get all staff details
    public function getStaffIndex(Request $request, int $id): JsonResponse
    {

        $staff = Staff::with(['subjectInformation'])
            ->where('id','=', $id )
            ->paginate(15);

        return response()->json([
            'staff' => $staff,
        ], JsonResponse::HTTP_OK);
    }

    // URI: /api/institute/staff/store
    // SUM: store the staff info
    public function postStaffStore(Request $request): JsonResponse
    {


        $staff_id = $request->input('staff_id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $staff_email = $request->input('staff_email');
        $staff_phone = $request->input('staff_phone');
        $staff_dob = $request->input('staff_dob');
        $subject_id = $request->input('subject_id');
        $staff_password = $request->input('staff_password');


        $staff =Staff::create([
            'staff_id'=> $staff_id,
            'first_name' => $first_name,
            'last_name'=> $last_name,
            'subject_id'=> $subject_id,
            'staff_email' => $staff_email,
            'staff_phone' => $staff_phone,
            'staff_dob' => $staff_dob,
            'staff_password'=> Hash::make('staff'),

        ]);


        return response()->json([
            'staff' => $staff,
        ], JsonResponse::HTTP_CREATED);
    }

    // URI: /
    // SUM: displays the staff data
    public function getStaffInformationShow( Request $request , int $id): JsonResponse
    {
        $staff = Staff::where('id', '=', $id)
            ->first();
        return response()->json([

            'staff' => $staff,
        ]);
    }




    // URI: /
    // SUM: updates the staff information
    public function patchStaffInformationUpdate(Request $request, int $id): JsonResponse

    {
        $staff_id = $request->input('staff_id');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $staff_email = $request->input('staff_email');
        $staff_phone = $request->input('staff_phone');
        $staff_dob = $request->input('staff_dob');
        $subject_id = $request->input('subject_id');


        Staff::toBase()
            ->where('id','=',$id)
            ->update([
                'staff_id'=> $staff_id,
                'first_name' => $first_name,
                'last_name'=> $last_name,
                'subject_id'=> $subject_id,
                'staff_email' => $staff_email,
                'staff_phone' => $staff_phone,
                'staff_dob' => $staff_dob,

            ]);

        return response()->json([
            'success' => 'update success',
        ], JsonResponse::HTTP_ACCEPTED);
    }

    // URI: /
    // SUM: deletes the staff data
    public function deleteStaffInformation(Request $request,int $id): JsonResponse
    {
        $staff=Staff::where('id','=',$id)->delete();
        return response()->json([
            'success' => 'delete success',
        ], JsonResponse::HTTP_NO_CONTENT);
    }
}
