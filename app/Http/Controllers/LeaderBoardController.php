<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classroom;
use App\ClassroomDivisionUser;
use App\Profile;

class LeaderBoardController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {

        $classroom = Classroom::find($id);

        $member = DB::table('classrooms')
        ->join('classroom_users', 'classroom_users.cls_id', '=', 'classrooms.cls_id')
        ->join('profiles', 'profiles.user_id', '=', 'classroom_users.user_id')
        ->where('classrooms.cls_id', '=', $id)
        ->get();

        $table =  Classroom::join('classroom_divisions', 'classroom_divisions.cls_id', '=', 'classrooms.cls_id')

        ->where('classrooms.cls_id', '=', $id)
        ->get();

        $team =  Classroom::join('classroom_divisions', 'classroom_divisions.cls_id', '=', 'classrooms.cls_id')
        ->join('classroom_division_users', 'classroom_division_users.div_id', '=', 'classroom_divisions.div_id')
        ->where('classrooms.cls_id', '=', $id)

        ->orderBy('classroom_division_users.div_id','asc')
        ->orderBy('classroom_division_users.div_usr_total_point', 'desc')
        ->get();

        $i = 1;
        $div_temp = 0;
        foreach ($team as $key => $teams) {
            $first = Profile::where('user_id', $teams->user_id)->value('prf_firstname');
            $lastname = Profile::where('user_id', $teams->user_id)->value('prf_lastname');
            $teams->realname = $first.' '.$lastname;

            if($div_temp <> $teams->div_id){
                // กำหนดเลข Ranking
                $i = 1;
            }
            $div_temp = $teams->div_id;
            $teams->rank = $i;
            $i++;

            //? อัพเดทข้อมูลลำดับ
            ClassroomDivisionUser::where('divu_id', $teams->divu_id)
            ->update(['div_usr_rank' => $teams->rank]);

        }

        return view('backend.leaderboard', compact('classroom','member','table','team'));
    }

    public function edit($id)
    {
        //
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
