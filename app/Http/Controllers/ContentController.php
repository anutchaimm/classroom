<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\ClassroomContent;
use Carbon\Carbon;


class ContentController extends Controller
{

    public function show($id)
    {
        $content = ClassroomContent::find($id);

        // ? set เวลา ไม่เข้าใจว่า ใช้ content แล้วมันไม่เปลี่ยนเลยต้องทำแบบนี้
        $createdates = Carbon::parse($content->created_at);
        $updatedates = Carbon::parse($content->updated_at);
        $createdates = $createdates->isoFormat('LL');
        $updatedates = $updatedates->diffForHumans();

        $comment = DB::table('classroom_contents')
                ->join('classroom_comments', 'classroom_comments.con_id', '=', 'classroom_contents.con_id')
                ->join('profiles', 'profiles.user_id', '=', 'classroom_comments.user_id')
                ->where('classroom_contents.con_id', '=', $id)
                ->select('classroom_contents.con_id',
                'classroom_comments.cmt_id',
                'classroom_comments.user_id',
                'classroom_comments.cmt_message',
                'classroom_comments.created_at',
                'classroom_comments.updated_at',
                'profiles.prf_img',
                'profiles.prf_firstname',
                'profiles.prf_lastname')
                ->get();

        foreach ($comment as $key => $comments) {
            $createdate = Carbon::parse($comments->created_at); // now date is a carbon instance
            $updatedate = Carbon::parse($comments->updated_at); // now date is a carbon instance
            $comments->created_at = $createdate->isoFormat('LL');
            $comments->updated_at = $updatedate->diffForHumans();

            $comments->user = User::find($comments->user_id);
        }

        //dd($comment);

        return view('backend.all_room', compact('content','comment','createdates','updatedates'));
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();
        if($request->ajax()){
            try{

                if($request->customfile){
                    $filePath =  $request->file('customfile')->store('files/'.$request->cls_id, 'public');
                    $original = $request->file('customfile')->getClientOriginalName();

                    ClassroomContent::find($request->id)->update([
                        'con_content' => $request->content,
                        'con_file' => $filePath,
                        'con_originalname' => $original
                    ]);

                }else{
                    ClassroomContent::find($request->id)->update([
                        'con_content' => $request->content
                    ]);
                }

                DB::commit();

                return response()->json($request);
                //return response()->json(['success' => 'เปลี่ยนข้อมูลสำเร็จ '.now(), 'name' => $request->content], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => 'เกิดข้อผิดพลาด '.now()], 500);
            }
        }
    }

    public function update(Request $request, $id)
    {
        // หา User ID
        $users = auth()->user()->id;
        DB::beginTransaction();
        try {
            if($request->customfile){
                $filePath =  $request->file('customfile')->store('files/'.$id, 'public');
                $original = $request->file('customfile')->getClientOriginalName();

            }else{
                $filePath = null;
                $original = null;
            }

            ClassroomContent::create([
                'cls_id' => $id,
                'user_id'=> $users,
                'con_content'=> $request->description,
                'con_file'=> $filePath,
                'con_originalname'=> $original
            ]);
            DB::commit();
            return redirect()->route('classroom.show', ['id' => $id])->with('status', 'Data inserted sucessfully!!');
        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->route('classroom.show', ['id' => $id])->with('status', 'Data inserted Faild!!');
        }

    }

    public function destroy($id)
    {
        ClassroomContent::where('con_id',$id)->delete();
        return redirect()->back()->with('message', 'Data deleted successfully');
    }
}
