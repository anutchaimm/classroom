<?php

namespace App\Http\Controllers;

use App\ClassroomDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ClassroomParing;
use App\ClassroomDivisionUser;


class PairingController extends Controller
{

    public function show($id)
    {

        $userid = auth()->user()->id;

        $division = ClassroomDivisionUser::where('cls_id', '=' , $id)
        ->where('user_id', '=', $userid)
        ->first();

        if(is_null($division)){

            return back()->withInput();
        }

        // dd($division);
        $total = ClassroomDivisionUser::where('div_id', '=' ,$division->div_id)->count();

        $friend = DB::table('classroom_users')
        ->join('profiles', 'profiles.user_id', '=', 'classroom_users.user_id')
        ->join('classroom_division_users', 'classroom_division_users.user_id', '=', 'classroom_users.user_id')
        // ->join('classroom_parings', 'classroom_parings.cls_id', '=', 'classroom_users.cls_id')
        ->where('classroom_users.cls_id', '=', $id)
        ->where('classroom_division_users.cls_id', '=', $id)
        ->inRandomOrder()
        ->get();

     //   dd($friend);

        foreach ($friend as $key => $friends) {

            if(($total/2) >= $friends->div_usr_rank){
                $friends->zone = "upper";
            }else{
                $friends->zone = "lower";
            }

            if($friends->user_id == $userid){

                $user_zone =  $friends->zone;
            }

            $friends->match = ClassroomParing::where('cls_id', $friends->cls_id)
            ->where('user_id', $userid)
            ->where('usr_paring', $friends->user_id)
            ->count();
        }

        return view('backend.pairing', compact('friend','userid','user_zone', 'id'));
    }

    public function edit(Request $request)
    {
            DB::beginTransaction();
            try{
                ClassroomParing::updateOrCreate(
                    ['cls_id' => $request->clsid, 'user_id' => $request->myid,'usr_paring' => $request->friendid],
                    ['par_status' => $request->status]);
                    DB::commit();
                return response()->json($request);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => 'เกิดข้อผิดพลาด '.now()], 500);
            }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
