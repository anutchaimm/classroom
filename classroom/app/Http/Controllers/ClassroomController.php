<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ClassroomController extends Controller
{
    public function show(Classroom $id)
    {
        $member = DB::table('classrooms')
                ->join('classroom_users', 'classroom_users.cls_id', '=', 'classrooms.cls_id')
                ->join('profiles', 'profiles.user_id', '=', 'classroom_users.user_id')
                ->where('classrooms.cls_id', '=', $id->cls_id)
                ->get();

        $post = DB::table('classrooms')
                ->join('classroom_contents', 'classroom_contents.cls_id', '=', 'classrooms.cls_id')
                ->join('profiles', 'profiles.user_id', '=', 'classroom_contents.user_id')
                ->where('classrooms.cls_id', '=', $id->cls_id)
                ->orderByDesc('classroom_contents.con_id')
                ->get();

                // TODO การเปลี่ยน Format date time to ภาษามนุษย์
                foreach ($post as $key => $posts) {
                    $createdate = Carbon::parse($posts->created_at); // now date is a carbon instance
                    $updatedate = Carbon::parse($posts->created_at); // now date is a carbon instance
                    $posts->created_at = $createdate->isoFormat('LL');
                    $posts->updated_at = $updatedate->diffForHumans();

                    $posts->user = User::find($posts->user_id);
                }

        //dd($id->classroomtype->clst_name);

        $classroom = Classroom::where('user_id', $id->user_id)
        ->where('cls_id', $id->cls_id)
        ->first();

        $owner = User::find($classroom->user_id);;

        $userid = auth()->user()->id;

        $user = User::find($userid);

        return view('backend.room',compact('id','member','post','user','owner'));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            if($request->cls_image){
                $cls_imagePath =  $request->file('cls_image')->store('classrooms_cover', 'public');
                $cls_image = Image::make(public_path("storage/{$cls_imagePath}"))->fit(1200,768);
                $cls_image->save();
                Classroom::where('cls_id', $id)
                ->update([
                    'cls_img' => $cls_imagePath,
                    ]
                );
                DB::commit();
            }

                Classroom::where('cls_id', $id)
                ->update([
                    'cls_name' => $request->cls_name,
                    'cls_subject' => $request->cls_subject,
                    'cls_term' => $request->cls_term,
                    'cls_duration'=> $request->cls_week,
                    'cls_level' => $request->cls_level,
                    'cls_type' => $request->cls_type
                ]
            );

            $id = Classroom::find($id);

            DB::commit();
            return redirect()->route('classroom.show', ['id' => $id])->with('status', 'Data inserted sucessfully!!');
        } catch (\Exception $e) {
            return 'Fails';
            DB::rollback();
            return redirect('classroom.show', ['id' => $id])->with('status', 'เพิ่มข้อมูลไม่สำเร็จ');
        }

    }

}
