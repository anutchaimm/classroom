<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Classroom;
use App\ClassroomUser;
use App\Profile;
use Illuminate\Support\Facades\Auth;


class ControlController extends Controller
{
    public function index()
    {
        $method = DB::table('classroom_types')->get();

        $userid = auth()->user()->id;

        $user = User::find($userid);

        //หาว่าตัวอย่างมีห้องไหนบ้าง
        $classroom = ClassroomUser::where('user_id', $userid)->get();

        foreach ($classroom as $value) {

                $value->total = ClassroomUser::where('cls_id', $value->cls_id)->count();
                $value->imgowner = Profile::where('user_id', $value->classroomname->user_id)->value('prf_img');
                $value->imgcover = Classroom::where('cls_id', $value->cls_id)->value('cls_img');
        }


        //dd(Auth::user()->classroomuser->classroomname);
        // Join 3 ชั้น
        // foreach (Auth::user()->classroomuser as $value) {
        //     echo $value->classroomname->cls_name;
        // }

        return view('backend.control',compact('method', 'classroom','user'));

    }

    public function store(Request $request)
    {

        $users = auth()->user()->id;


        $message = [
            'term.required' => "กรุณากรอกข้อมูล",
            'type.required' => "กรุณากรอกข้อมูล",
        ];

        $validate = Validator::make($request->all(), [
            'term' => 'required',
            'type' => 'required'
        ], $message);

        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }

        do{
            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $length = 8;
            $code = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
            $user_code = Classroom::where('cls_code', $code)->get();

        }while($user_code <> '[]');

        DB::beginTransaction();

       // dd($request->name);

        try {
            Classroom::create([
                'user_id' => $users,
                'cls_code'=> $code,
                'cls_name'=> $request->name,
                'cls_subject'=> $request->subject,
                'cls_term'=> $request->term,
                'cls_duration'=> $request->week,
                'cls_level'=> $request->level,
                'cls_type'=> $request->type,
                'cls_status'=> 1
            ]);

            //! ระวัง
            $classroom = Classroom::max('cls_id');

            ClassroomUser::create([
                'cls_id' => $classroom,
                'user_id'=> $users
            ]);

            DB::commit();
            return redirect()->route('control')->with('status', 'Sucessfully!!');
        } catch (\Exception $e) {
            return redirect()->route('control')->with('status', 'Failed!!');
            DB::rollback();
        }
    }

    public function create(Request $request)
    {

        // หา User ID
        $users = auth()->user()->id;
        // หา เลข Classroom
        $classroom = Classroom::where('cls_code', $request->code)->value('cls_id');

        if(empty($classroom)){

            //echo 'ไม่มีข้อมูล';
            return redirect()->route('control')->with('status', 'Not Found Classroom!!');
        }else{

            $exitsuser = ClassroomUser::where('cls_id', $classroom)
                        ->where('user_id', $users)
                        ->count();

            if($exitsuser > 0){

                //echo 'ข้อมูลซ้ำ';
                return redirect()->route('control')->with('status', 'Classroom has exits!!');

            }else{

                DB::beginTransaction();

                try {
                    ClassroomUser::create([
                        'cls_id' => $classroom,
                        'user_id'=> $users
                    ]);
                    DB::commit();
                    return redirect()->route('control')->with('status', 'Sucessfully!!');
                } catch (\Exception $e) {

                    return redirect()->route('control')->with('status', 'Failed!!');
                    DB::rollback();
                }
            }
        }
    }
}






//        $member = ClassroomUser::where('user_id', $userid)->get();
   // dd($user->profile);

        // TODO ขั้นตอนการ where หลายชั้น

        // if ($member->count() == 0)  {

        //         $classroom = auth()->user()->classroom;
        // }else{

        //     foreach ($member as $key => $tests) {
        //         $classroom[$key] = Classroom::where('cls_id', $tests->cls_id)->get();
        //     }


        // }


        // foreach ($classroom as $key => $classrooms) {


        //     echo $classrooms->cls_id;

            //dd($classrooms);

          //  foreach ($classrooms as $classroomss) {

                //dd($value->cls_id);
           //     echo $classroomss->cls_id;

                // $value->total = ClassroomUser::where('cls_id', $value->cls_id)->count();
                // $value->imgowner = Profile::where('user_id', $value->user_id)->value('prf_img');
                // $value->imgcover = Classroom::where('cls_id', $value->cls_id)->value('cls_img');

            //  dd($value);
       //     }

      //  }

      //  dd($classroom);
      // dd(Auth::user()->classroom);
